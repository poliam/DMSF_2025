<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\BloodSugarController;
use App\Http\Controllers\LaboratoryController;
use App\Http\Controllers\TelemedicinePerceptionController;
use App\Http\Controllers\NutritionController;
use App\Http\Controllers\FoodRecallController;
use App\Http\Controllers\TdeeController;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\QualityOfLifeController;
use App\Http\Controllers\SocialConnectednessController;
use App\Http\Controllers\StressManagementController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\PhysicalActivityController;
use App\Http\Controllers\InformedConsentController;
use App\Http\Controllers\ResearchEligibilityController;
use App\Http\Controllers\ResearchExclusionController;
use App\Http\Controllers\ComprehensiveHistoryController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\PhysicalExaminationController;
use App\Http\Controllers\DiagnosticController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SleepScreeningController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
Route::post('/patients/{patient}/update-diagnosis', [PatientController::class, 'updateDiagnosis'])->name('patients.update-diagnosis');
Route::post('/patients/{patient}/update-height', [PatientController::class, 'updateHeight'])->name('patients.update-height');
Route::post('/patients/{patient}/update-weight', [PatientController::class, 'updateWeight'])->name('patients.update-weight');
Route::post('/patients/{patient}/update-waist', [PatientController::class, 'updateWaist'])->name('patients.update-waist');
Route::post('/patients/{patient}/update-hip', [PatientController::class, 'updateHip'])->name('patients.update-hip');
Route::post('/patients/{patient}/update-neck', [PatientController::class, 'updateNeck'])->name('patients.update-neck');
Route::post('/patients/{patient}/update-temperature', [PatientController::class, 'updateTemperature'])->name('patients.update-temperature');
Route::post('/patients/{patient}/update-heart-rate', [PatientController::class, 'updateHeartRate'])->name('patients.update-heart-rate');
Route::post('/patients/{patient}/update-o2-saturation', [PatientController::class, 'updateO2Saturation'])->name('patients.update-o2-saturation');
Route::post('/patients/{patient}/update-respiratory-rate', [PatientController::class, 'updateRespiratoryRate'])->name('patients.update-respiratory-rate');
Route::post('/patients/{patient}/update-blood-pressure', [PatientController::class, 'updateBloodPressure'])->name('patients.update-blood-pressure');

// Diagnostic routes
Route::get('/patients/{patient}/diagnostics', [DiagnosticController::class, 'index'])->name('patients.diagnostics');
Route::post('/diagnostics', [DiagnosticController::class, 'store'])->name('diagnostics.store');
Route::get('/diagnostics/{id}', [DiagnosticController::class, 'show'])->name('diagnostics.show');
Route::get('/diagnostic/{diagnosticId}/print', [DiagnosticController::class, 'print'])->name('diagnostics.print');

// Tab-specific measurement routes
Route::post('/patients/{patient}/update-measurement', [PatientController::class, 'updateMeasurement'])->name('patients.update-measurement');
Route::post('/patients/{patient}/update-measurement-date', [PatientController::class, 'updateMeasurementDate'])->name('patients.update-measurement-date');
Route::get('/patients/{patient}/measurements/{tabNumber}/{date?}', [PatientController::class, 'getMeasurementsForTab'])->name('patients.get-measurements-for-tab');
Route::get('/patients/{patient}/measurements/{tab}', [PatientController::class, 'getMeasurementsForTab'])->name('patients.get-measurements');

Route::get('/patient/latest-reference-number', [PatientController::class, 'getLatestReferenceNumber']);

Route::get('/patient/{patient_id}/macronutrients', [PatientController::class, 'getMacronutrients']);

Route::post('/patients/{id}/blood-sugar', [BloodSugarController::class, 'store'])->name('blood-sugar.store');
Route::get('/patients/{id}/blood-sugar', [BloodSugarController::class, 'index'])->name('patients.blood-sugar.index');

Route::get('/blood-sugar/create', [BloodSugarController::class, 'create']);
Route::post('/blood-sugar/store', [BloodSugarController::class, 'store']);

Route::post('/telemedicine_perception/store', [TelemedicinePerceptionController::class, 'store'])->name('telemedicine_perception.store');

Route::post('/patients/{patient}/laboratory', [LaboratoryController::class, 'store'])->name('patients.laboratory.store');
Route::post('/patients/{patient}/laboratory/upload', [LaboratoryController::class, 'uploadLabResult'])->name('patients.laboratory.upload');

Route::post('/nutrition/store', [NutritionController::class, 'store'])->name('nutrition.store');

Route::post('/food-recall/store', [FoodRecallController::class, 'store'])->name('food-recall.store');
Route::get('/food-recall/{nutritionId}', [FoodRecallController::class, 'getFoodRecalls']);

Route::post('/tdee', [TdeeController::class, 'store'])->name('tdee.store');

Route::get('/get-meal-plans/{patient}', [MealPlanController::class, 'getMealPlans'])->name('get-meal-plans');

Route::post('/save-meal-plan', [MealPlanController::class, 'store'])->name('save-meal-plan');

Route::post('/qualityoflife/store', [QualityOfLifeController::class, 'store'])->name('qualityoflife.store');
Route::get('/qualityoflife/{patient_id}', [QualityOfLifeController::class, 'index'])->name('qualityoflife.index');

Route::post('/social-connectedness', [SocialConnectednessController::class, 'store'])->name('submit.socialConnectedness');
Route::get('/social-connectedness/{patient_id}', [SocialConnectednessController::class, 'show'])->name('get.socialConnectedness');

Route::post('/stress-management', [StressManagementController::class, 'store'])->name('submit.stressManagement');
Route::get('/stress-management/{patientId}', [StressManagementController::class, 'getDataByPatient'])->name('stressManagement.getDataByPatient');

Route::get('/medicines/search', [MedicineController::class, 'getMedicines'])->name('medicines.search');


Route::post('/prescription-add', [PrescriptionController::class, 'store'])->name('prescription.store');
Route::get('/prescription/{prescriptionId}/print', [PrescriptionController::class, 'print']);
Route::get('/patients/{patient}/prescriptions', [PrescriptionController::class, 'getByPatient'])->name('patients.prescriptions');
Route::put('/prescriptions/{prescriptionId}/update', [PrescriptionController::class, 'update']);

Route::post('/physical-activity', [PhysicalActivityController::class, 'store'])->name('physical-activity.store');
Route::get('/physical-activity/{id}', [PhysicalActivityController::class, 'show'])->name('physical-activity.show');
Route::get('/physical-activity', [PhysicalActivityController::class, 'get_lists'])->name('physical-activity.get_lists');

Route::get('/informed-consent/check/{patientId}', [InformedConsentController::class, 'checkConsentSubmitted'])->name('informed_consent.check');
Route::post('/informed-consent/store', [InformedConsentController::class, 'store'])->name('informed_consent.store');

Route::get('/research-eligibility/{patientId}', [ResearchEligibilityController::class, 'showForm'])->name('research_eligibility.show');
Route::post('/research-eligibility/store', [ResearchEligibilityController::class, 'store'])->name('research_eligibility.store');

Route::get('/research-eligibility/check/{patientId}', [ResearchEligibilityController::class, 'check'])->name('research_eligibility.check');

Route::post('/first-encounter-screening/store', [ResearchEligibilityController::class, 'storeFirstEncounter'])->name('first-encounter-screening.store');

// Review of Systems routes (consultation-based)
Route::get('/patients/{patient}/consultations', [\App\Http\Controllers\ReviewOfSystemController::class, 'getConsultations']);
Route::get('/patients/{patient}/review-of-systems/{consultationType}', [\App\Http\Controllers\ReviewOfSystemController::class, 'getReviewOfSystems']);
Route::post('/patients/{patient}/review-of-systems', [\App\Http\Controllers\ReviewOfSystemController::class, 'saveReviewOfSystems']);
Route::post('/patients/{patient}/consultation-date', [\App\Http\Controllers\ReviewOfSystemController::class, 'updateConsultationDate']);

Route::get('/assessments', [AssessmentController::class, 'index'])->name('assessments.index');
Route::post('/assessments', [AssessmentController::class, 'store'])->name('assessments.store');
Route::get('/assessments/patient/{patient}', [AssessmentController::class, 'getByPatient'])->name('assessments.byPatient');

// Exclusion Criteria Routes
Route::post('/research-exclusion/store', [\App\Http\Controllers\ResearchExclusionController::class, 'store'])->name('research_exclusion.store');
Route::get('/research-exclusion/check/{patientId}', [\App\Http\Controllers\ResearchExclusionController::class, 'check'])->name('research_exclusion.check');

Route::get('/patients/{patient}/comprehensive-history', [ComprehensiveHistoryController::class, 'show'])->name('comprehensive-history.show');
Route::get('/patients/{patient}/comprehensive-history/data', [ComprehensiveHistoryController::class, 'get'])->name('comprehensive-history.get');
Route::post('/patients/{patient}/comprehensive-history', [ComprehensiveHistoryController::class, 'store'])->name('comprehensive-history.store');

// Debug route
Route::get('/debug/comprehensive-history/{patient}', function(App\Models\Patient $patient) {
    $comprehensiveHistory = $patient->comprehensiveHistory()->first();
    return [
        'patient_id' => $patient->id,
        'patient_name' => $patient->first_name . ' ' . $patient->last_name,
        'comprehensive_history_exists' => $comprehensiveHistory ? 'Yes' : 'No',
        'comprehensive_history_data' => $comprehensiveHistory
    ];
});

// Physical Examination Routes
Route::post('/patients/{patient}/general-survey', [PhysicalExaminationController::class, 'storeGeneralSurvey'])->name('physical-examination.general-survey');
Route::post('/patients/{patient}/skin-hair', [PhysicalExaminationController::class, 'storeSkinHair'])->name('physical-examination.skin-hair');
Route::post('/patients/{patient}/finger-nails', [PhysicalExaminationController::class, 'storeFingerNails'])->name('physical-examination.finger-nails');
Route::post('/patients/{patient}/head', [PhysicalExaminationController::class, 'storeHead'])->name('physical-examination.head');
Route::post('/patients/{patient}/eyes', [PhysicalExaminationController::class, 'storeEyes'])->name('physical-examination.eyes');
Route::post('/patients/{patient}/ear', [PhysicalExaminationController::class, 'storeEar'])->name('physical-examination.ear');
Route::post('/patients/{patient}/neck', [PhysicalExaminationController::class, 'storeNeck'])->name('physical-examination.neck');
Route::post('/patients/{patient}/back-posture', [PhysicalExaminationController::class, 'storeBackPosture'])->name('physical-examination.back-posture');
Route::post('/patients/{patient}/thorax-lungs', [PhysicalExaminationController::class, 'storeThoraxLungs'])->name('physical-examination.thorax-lungs');
Route::post('/patients/{patient}/cardiac-exam', [PhysicalExaminationController::class, 'storeCardiacExam'])->name('physical-examination.cardiac-exam');
Route::post('/patients/{patient}/abdomen', [PhysicalExaminationController::class, 'storeAbdomen'])->name('physical-examination.abdomen');
Route::post('/patients/{patient}/breast-axillae', [PhysicalExaminationController::class, 'storeBreastAxillae'])->name('physical-examination.breast-axillae');
Route::post('/patients/{patient}/male-genitalia', [PhysicalExaminationController::class, 'storeMaleGenitalia'])->name('physical-examination.male-genitalia');
Route::post('/patients/{patient}/female-genitalia', [PhysicalExaminationController::class, 'storeFemaleGenitalia'])->name('physical-examination.female-genitalia');
Route::post('/patients/{patient}/extremities', [PhysicalExaminationController::class, 'storeExtremities'])->name('physical-examination.extremities');
Route::post('/patients/{patient}/nervous-system', [PhysicalExaminationController::class, 'storeNervousSystem'])->name('physical-examination.nervous-system');

// Save all physical examination sections at once
Route::post('/patients/{patient}/physical-examination/save-all', [PhysicalExaminationController::class, 'saveAll'])->name('physical-examination.save-all');

// Get all physical examination data
Route::get('/patients/{patient}/physical-examination', [PhysicalExaminationController::class, 'getAll'])->name('physical-examination.get-all');

Route::resource('sleep-screenings', SleepScreeningController::class);

require __DIR__.'/auth.php';
