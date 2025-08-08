<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Consultation;
use App\Models\Prescription;
use App\Models\Diagnostic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Cache dashboard data for 5 minutes to improve performance
        $dashboardData = Cache::remember('dashboard_data', 300, function () {
            return $this->getDashboardData();
        });

        return view('dashboard.index', $dashboardData);
    }

    public function getData()
    {
        try {
            // Return JSON data for AJAX requests
            $dashboardData = Cache::remember('dashboard_data', 300, function () {
                return $this->getDashboardData();
            });

            // Add debug info
            $dashboardData['debug'] = [
                'timestamp' => now(),
                'cache_key' => 'dashboard_data',
                'total_patients_debug' => Patient::count()
            ];

            return response()->json($dashboardData);
        } catch (\Exception $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ], 500);
        }
    }

    private function getDashboardData()
    {
        try {
            $currentYear = now()->year;
            $currentMonth = now()->month;

            // Use a single query to get basic counts
            $basicCounts = Cache::remember('dashboard_basic_counts', 300, function () {
                return [
                    'totalPatients' => Patient::count(),
                    'totalConsultations' => Consultation::count(),
                    'prescribedCount' => Prescription::count(),
                    'diagnosticRequests' => Diagnostic::count(),
                ];
            });

            // Get monthly data for current month in a single query
            $monthlyData = Cache::remember("dashboard_monthly_data_{$currentYear}_{$currentMonth}", 300, function () use ($currentYear, $currentMonth) {
                return [
                    'newPatientsThisMonth' => Patient::whereMonth('created_at', $currentMonth)
                        ->whereYear('created_at', $currentYear)
                        ->count(),
                    'consultationsThisMonth' => Consultation::whereMonth('consultation_date', $currentMonth)
                        ->whereYear('consultation_date', $currentYear)
                        ->count(),
                ];
            });

            // Get monthly patient registration data using a single optimized query
            $monthlyPatientsData = Cache::remember("dashboard_monthly_patients_{$currentYear}", 600, function () use ($currentYear) {
                $monthlyData = Patient::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
                    ->whereYear('created_at', $currentYear)
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->pluck('count', 'month')
                    ->toArray();

                // Fill in missing months with 0
                $result = [];
                for ($month = 1; $month <= 12; $month++) {
                    $result[] = $monthlyData[$month] ?? 0;
                }
                
                return $result;
            });

            // Get diabetes status distribution with optimized query
            $diabetesData = Cache::remember('dashboard_diabetes_data', 300, function () {
                return Patient::selectRaw('
                    SUM(CASE WHEN diabetes_status = "Not Diabetic" THEN 1 ELSE 0 END) as not_diabetic,
                    SUM(CASE WHEN diabetes_status = "Prediabetes" THEN 1 ELSE 0 END) as prediabetes,
                    SUM(CASE WHEN diabetes_status = "DM Type I" THEN 1 ELSE 0 END) as dm_type_1,
                    SUM(CASE WHEN diabetes_status = "DM Type II" THEN 1 ELSE 0 END) as dm_type_2,
                    SUM(CASE WHEN diabetes_status = "Gestational DM" THEN 1 ELSE 0 END) as gestational_dm,
                    SUM(CASE WHEN diabetes_status = "Other Hyperglycemic States" THEN 1 ELSE 0 END) as other_hyperglycemic,
                    SUM(CASE WHEN diabetes_status = "Pending" THEN 1 ELSE 0 END) as pending,
                    COUNT(*) as total_count
                ')->first();
            });

            // Get demographic data for charts with fallback
            $demographicData = Cache::remember('dashboard_demographic_data', 600, function () {
                $result = [
                    'ageGroups' => [],
                    'gender' => [],
                    'maritalStatus' => [],
                    'education' => [],
                    'income' => [],
                    'religion' => [],
                ];
                
                try {
                    // Age groups (calculated from birth_date)
                    $result['ageGroups'] = Patient::selectRaw('
                        CASE 
                            WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < 18 THEN "Under 18"
                            WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 18 AND 29 THEN "18-29"
                            WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 30 AND 39 THEN "30-39"
                            WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 40 AND 49 THEN "40-49"
                            WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) BETWEEN 50 AND 59 THEN "50-59"
                            WHEN TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) >= 60 THEN "60+"
                            ELSE "Unknown"
                        END as age_group,
                        COUNT(*) as count
                    ')->whereNotNull('birth_date')
                    ->groupBy('age_group')
                    ->pluck('count', 'age_group')
                    ->toArray();

                    // Gender distribution
                    $result['gender'] = Patient::selectRaw('gender, COUNT(*) as count')
                        ->whereNotNull('gender')
                        ->groupBy('gender')
                        ->pluck('count', 'gender')
                        ->toArray();

                    // Marital status
                    $result['maritalStatus'] = Patient::selectRaw('marital_status, COUNT(*) as count')
                        ->whereNotNull('marital_status')
                        ->groupBy('marital_status')
                        ->pluck('count', 'marital_status')
                        ->toArray();

                    // Education level
                    $result['education'] = Patient::selectRaw('highest_educational_attainment, COUNT(*) as count')
                        ->whereNotNull('highest_educational_attainment')
                        ->groupBy('highest_educational_attainment')
                        ->pluck('count', 'highest_educational_attainment')
                        ->toArray();

                    // Income brackets
                    $result['income'] = Patient::selectRaw('monthly_household_income, COUNT(*) as count')
                        ->whereNotNull('monthly_household_income')
                        ->groupBy('monthly_household_income')
                        ->pluck('count', 'monthly_household_income')
                        ->toArray();

                    // Religion
                    $result['religion'] = Patient::selectRaw('religion, COUNT(*) as count')
                        ->whereNotNull('religion')
                        ->groupBy('religion')
                        ->pluck('count', 'religion')
                        ->toArray();
                } catch (\Exception $e) {
                    // If there's an error getting demographic data, use empty arrays
                }
                
                return $result;
            });

            // Get consultation trends data
            $consultationTrendsData = Cache::remember("dashboard_consultation_trends_{$currentYear}", 600, function () use ($currentYear) {
                $monthlyData = Consultation::selectRaw('MONTH(consultation_date) as month, COUNT(*) as count')
                    ->whereYear('consultation_date', $currentYear)
                    ->groupBy(DB::raw('MONTH(consultation_date)'))
                    ->pluck('count', 'month')
                    ->toArray();

                // Fill in missing months with 0
                $result = [];
                for ($month = 1; $month <= 12; $month++) {
                    $result[] = $monthlyData[$month] ?? 0;
                }
                
                return $result;
            });

            // Calculate derived values
            $totalPatients = $basicCounts['totalPatients'];
            
            return [
                'totalPatients' => $totalPatients,
                'totalConsultations' => $basicCounts['totalConsultations'],
                'newPatientsThisMonth' => $monthlyData['newPatientsThisMonth'],
                'consultationsThisMonth' => $monthlyData['consultationsThisMonth'],
                
                // Age distribution for charts
                'age_18_30' => ($demographicData['ageGroups']['18-29'] ?? 0),
                'age_31_45' => ($demographicData['ageGroups']['30-39'] ?? 0) + ($demographicData['ageGroups']['40-49'] ?? 0),
                'age_46_60' => ($demographicData['ageGroups']['50-59'] ?? 0),
                'age_60_plus' => ($demographicData['ageGroups']['60+'] ?? 0),
                
                // Gender distribution
                'male' => $demographicData['gender']['Male'] ?? $demographicData['gender']['male'] ?? 0,
                'female' => $demographicData['gender']['Female'] ?? $demographicData['gender']['female'] ?? 0,
                'other' => $demographicData['gender']['Other'] ?? $demographicData['gender']['other'] ?? 0,
                
                // Other demographic data
                'maritalStatus' => $demographicData['maritalStatus'],
                'education' => $demographicData['education'],
                'income' => $demographicData['income'],
                'religion' => $demographicData['religion'],
                
                // Patient trends data
                'patientTrends' => [
                    'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    'counts' => $monthlyPatientsData
                ],
                
                // Consultation trends data
                'consultationTrends' => [
                    'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    'counts' => $consultationTrendsData
                ],
                
                // Prescription data
                'withPrescription' => $basicCounts['prescribedCount'],
                'withoutPrescription' => $totalPatients - $basicCounts['prescribedCount'],
                
                // Diagnostic data
                'withDiagnostics' => $basicCounts['diagnosticRequests'],
                'withoutDiagnostics' => $totalPatients - $basicCounts['diagnosticRequests'],
                
                // Diabetes status distribution data
                'diabetesStatus' => [
                    'Not Diabetic' => $diabetesData->not_diabetic ?? 0,
                    'Prediabetes' => $diabetesData->prediabetes ?? 0,
                    'DM Type I' => $diabetesData->dm_type_1 ?? 0,
                    'DM Type II' => $diabetesData->dm_type_2 ?? 0,
                    'Gestational DM' => $diabetesData->gestational_dm ?? 0,
                    'Other Hyperglycemic States' => $diabetesData->other_hyperglycemic ?? 0,
                    'Pending' => $diabetesData->pending ?? 0,
                ],
            ];
        } catch (\Exception $e) {
            // Return minimal fallback data
            return [
                'totalPatients' => 0,
                'totalConsultations' => 0,
                'newPatientsThisMonth' => 0,
                'consultationsThisMonth' => 0,
                'age_18_30' => 0,
                'age_31_45' => 0,
                'age_46_60' => 0,
                'age_60_plus' => 0,
                'male' => 0,
                'female' => 0,
                'other' => 0,
                'maritalStatus' => [],
                'education' => [],
                'income' => [],
                'religion' => [],
                'patientTrends' => [
                    'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    'counts' => [0,0,0,0,0,0,0,0,0,0,0,0]
                ],
                'consultationTrends' => [
                    'months' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    'counts' => [0,0,0,0,0,0,0,0,0,0,0,0]
                ],
                'withPrescription' => 0,
                'withoutPrescription' => 0,
                'withDiagnostics' => 0,
                'withoutDiagnostics' => 0,
                'diabetesStatus' => [
                    'Not Diabetic' => 0,
                    'Prediabetes' => 0,
                    'DM Type I' => 0,
                    'DM Type II' => 0,
                    'Gestational DM' => 0,
                    'Other Hyperglycemic States' => 0,
                    'Pending' => 0,
                ],
                'error' => true,
                'error_message' => $e->getMessage()
            ];
        }
    }
}
