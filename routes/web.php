<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
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
use App\Http\Controllers\SocialInitialAssessmentController as SocialInitial;
use App\Http\Controllers\SCS8AssessmentController as SCS8;
use App\Http\Controllers\FamilyAPGARAssessmentController as FamilyAPGAR;
use App\Http\Controllers\StressManagementController;
use App\Http\Controllers\StressInitialAssessmentController as StressInitial;
use App\Http\Controllers\GAD7AssessmentController as GAD7;
use App\Http\Controllers\PHQ9AssessmentController as PHQ9;
use App\Http\Controllers\PSS4AssessmentController as PSS4;
use App\Http\Controllers\FND6AssessmentController as FND6;
use App\Http\Controllers\CAGE4AssessmentController as CAGE4;
use App\Http\Controllers\ASSIST8AssessmentController as ASSIST8;
use App\Http\Controllers\SubstanceScreenerRecommendationController as SubstanceRecs;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\MedicalCertificateController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ReferralFormController;
use App\Http\Controllers\PhysicalActivityController;
use App\Http\Controllers\InformedConsentController;
use App\Http\Controllers\ResearchEligibilityController;
use App\Http\Controllers\ResearchExclusionController;
use App\Http\Controllers\ComprehensiveHistoryController;
use App\Http\Controllers\ComprehensiveHistoryAttachmentController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\PhysicalExaminationController;
use App\Http\Controllers\DiagnosticController;
use App\Http\Controllers\ConsultationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SleepScreeningController;
use App\Http\Controllers\SleepAssessmentController;
use App\Http\Controllers\SleepInitialAssessmentController;
use App\Http\Controllers\ISI7AssessmentController;
use App\Http\Controllers\ESS8AssessmentController;
use App\Http\Controllers\SHI13AssessmentController;
use App\Http\Controllers\STOPBANGAssessmentController;
use App\Http\Controllers\LifestylePrescriptionController;


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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard-data', [DashboardController::class, 'getData'])->middleware(['auth', 'verified'])->name('dashboard.data');

// role bhw_s1
Route::middleware(['auth', 'role:bhw_s1|admin|doctor'])->group(function () {
    Route::get('/patients/create', [PatientController::class, 'create'])->name('patients.create');
    Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');

    // First encounter
    Route::post('/informed-consent/store', [InformedConsentController::class, 'store'])->name('informed_consent.store');
    Route::post('/first-encounter-screening/store', [ResearchEligibilityController::class, 'storeFirstEncounter'])->name('first-encounter-screening.store');
});

Route::middleware(['auth', 'role:bhw_s3|bhw_s4|bhw_s5|bhw_s6|admin|doctor'])->group(function () {
    Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
    Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])->name('patients.edit');
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

    Route::post('/patients/{patient}/update-measurement', [PatientController::class, 'updateMeasurement'])->name('patients.update-measurement');
    Route::post('/patients/{patient}/update-measurement-date', [PatientController::class, 'updateMeasurementDate'])->name('patients.update-measurement-date');
    Route::get('/patients/{patient}/measurements/{tabNumber}/{date?}', [PatientController::class, 'getMeasurementsForTab'])->name('patients.get-measurements-for-tab');
    Route::get('/patients/{patient}/measurements/{tab}', [PatientController::class, 'getMeasurementsForTab'])->name('patients.get-measurements');
});

Route::middleware(['auth', 'role:bhw_s4|bhw_s5|bhw_s6|admin|doctor'])->group(function () {
    // First encounter
    Route::get('/research-eligibility/{patientId}', [ResearchEligibilityController::class, 'showForm'])->name('research_eligibility.show');
    Route::post('/research-eligibility/store', [ResearchEligibilityController::class, 'store'])->name('research_eligibility.store');
    Route::get('/research-eligibility/check/{patientId}', [ResearchEligibilityController::class, 'check'])->name('research_eligibility.check');
    Route::post('/first-encounter-screening/store', [ResearchEligibilityController::class, 'storeFirstEncounter'])->name('first-encounter-screening.store');


    // Exclusion Criteria Routes
    Route::post('/research-exclusion/store', [\App\Http\Controllers\ResearchExclusionController::class, 'store'])->name('research_exclusion.store');
    Route::get('/research-exclusion/check/{patientId}', [\App\Http\Controllers\ResearchExclusionController::class, 'check'])->name('research_exclusion.check');
    Route::get('/patients/{patient}/comprehensive-history', [ComprehensiveHistoryController::class, 'show'])->name('comprehensive-history.show');
    Route::get('/patients/{patient}/comprehensive-history/data', [ComprehensiveHistoryController::class, 'get'])->name('comprehensive-history.get');
    Route::post('/patients/{patient}/comprehensive-history', [ComprehensiveHistoryController::class, 'store'])->name('comprehensive-history.store');
});


Route::middleware(['auth', 'role:bhw_s5|bhw_s6|admin|doctor'])->group(function () {
    // Consultation management routes
    Route::post('/consultations/{consultation}/update-date', [ConsultationController::class, 'updateDate'])->name('consultations.update-date');
    Route::get('/consultations/{consultation}/has-screening-data', [ConsultationController::class, 'hasScreeningData'])->name('consultations.has-screening-data');
    Route::get('/consultations/{consultation}/data', [ConsultationController::class, 'getConsultationData'])->name('consultations.data');
    Route::get('/patients/{patient}/ensure-consultations', [ConsultationController::class, 'ensureConsultations'])->name('patients.ensure-consultations');

    // LD screening tools
    Route::get('/consultations/{consultation}/nutrition', [NutritionController::class, 'getByConsultation'])->name('nutrition.by-consultation');
    Route::get('/consultations/{consultation}/quality-of-life', [QualityOfLifeController::class, 'getByConsultation'])->name('quality-of-life.by-consultation');
    Route::get('/consultations/{consultation}/telemedicine-perception', [TelemedicinePerceptionController::class, 'getByConsultation'])->name('telemedicine-perception.by-consultation');
    Route::get('/consultations/{consultation}/physical-activity', [PhysicalActivityController::class, 'getByConsultation'])->name('physical-activity.by-consultation');
    Route::post('/physical-activity', [PhysicalActivityController::class, 'store'])->name('physical-activity.store');
    Route::get('/physical-activity/{id}', [PhysicalActivityController::class, 'show'])->name('physical-activity.show');
    Route::get('/physical-activity', [PhysicalActivityController::class, 'get_lists'])->name('physical-activity.get_lists');

    // Tab-specific measurement routes

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


    // New social connectedness per-assessment routes
    Route::post('/social-initial-assessments', [SocialInitial::class, 'store'])->name('social-initial-assessments.store');
    Route::get('/social-initial-assessments/{patientId}', [SocialInitial::class, 'show'])->name('social-initial-assessments.show');
    Route::post('/scs8-assessments', [SCS8::class, 'store'])->name('scs8-assessments.store');
    Route::get('/scs8-assessments/{patientId}', [SCS8::class, 'show'])->name('scs8-assessments.show');
    Route::post('/family-apgar-assessments', [FamilyAPGAR::class, 'store'])->name('family-apgar-assessments.store');
    Route::get('/family-apgar-assessments/{patientId}', [FamilyAPGAR::class, 'show'])->name('family-apgar-assessments.show');

    // Stress management routes (initial + specific assessments)
    Route::post('/stress-initial-assessments', [StressInitial::class, 'store'])->name('stress-initial-assessments.store');
    Route::get('/stress-initial-assessments/{patientId}', [StressInitial::class, 'show'])->name('stress-initial-assessments.show');
    Route::put('/stress-initial-assessments/{id}', [StressInitial::class, 'update'])->name('stress-initial-assessments.update');

    Route::post('/gad7-assessments', [GAD7::class, 'store'])->name('gad7-assessments.store');
    Route::get('/gad7-assessments/{patientId}', [GAD7::class, 'show'])->name('gad7-assessments.show');
    Route::put('/gad7-assessments/{id}', [GAD7::class, 'update'])->name('gad7-assessments.update');

    Route::post('/phq9-assessments', [PHQ9::class, 'store'])->name('phq9-assessments.store');
    Route::get('/phq9-assessments/{patientId}', [PHQ9::class, 'show'])->name('phq9-assessments.show');
    Route::put('/phq9-assessments/{id}', [PHQ9::class, 'update'])->name('phq9-assessments.update');

    Route::post('/pss4-assessments', [PSS4::class, 'store'])->name('pss4-assessments.store');
    Route::get('/pss4-assessments/{patientId}', [PSS4::class, 'show'])->name('pss4-assessments.show');
    Route::put('/pss4-assessments/{id}', [PSS4::class, 'update'])->name('pss4-assessments.update');

    // Substance use assessments
    Route::post('/fnd6-assessments', [FND6::class, 'store'])->name('fnd6-assessments.store');
    Route::get('/fnd6-assessments/{patientId}', [FND6::class, 'show'])->name('fnd6-assessments.show');
    Route::post('/cage4-assessments', [CAGE4::class, 'store'])->name('cage4-assessments.store');
    Route::get('/cage4-assessments/{patientId}', [CAGE4::class, 'show'])->name('cage4-assessments.show');
    Route::post('/assist8-assessments', [ASSIST8::class, 'store'])->name('assist8-assessments.store');
    Route::get('/assist8-assessments/{patientId}', [ASSIST8::class, 'show'])->name('assist8-assessments.show');

    // Save all physical examination sections at once
    Route::post('/patients/{patient}/physical-examination/save-all', [PhysicalExaminationController::class, 'saveAll'])->name('physical-examination.save-all');

    // Get all physical examination data
    Route::get('/patients/{patient}/physical-examination', [PhysicalExaminationController::class, 'getAll'])->name('physical-examination.get-all');

    Route::resource('sleep-screenings', SleepScreeningController::class);

    // Sleep Initial Assessment routes
    Route::post('/sleep-initial-assessments', [SleepInitialAssessmentController::class, 'store'])->name('sleep-initial-assessments.store');
    Route::get('/sleep-initial-assessments/{patientId}', [SleepInitialAssessmentController::class, 'show'])->name('sleep-initial-assessments.show');
    Route::put('/sleep-initial-assessments/{id}', [SleepInitialAssessmentController::class, 'update'])->name('sleep-initial-assessments.update');

    // ISI-7 Assessment routes
    Route::post('/isi7-assessments', [ISI7AssessmentController::class, 'store'])->name('isi7-assessments.store');
    Route::get('/isi7-assessments/{patientId}', [ISI7AssessmentController::class, 'show'])->name('isi7-assessments.show');
    Route::put('/isi7-assessments/{id}', [ISI7AssessmentController::class, 'update'])->name('isi7-assessments.update');

    // ESS-8 Assessment routes
    Route::post('/ess8-assessments', [ESS8AssessmentController::class, 'store'])->name('ess8-assessments.store');
    Route::get('/ess8-assessments/{patientId}', [ESS8AssessmentController::class, 'show'])->name('ess8-assessments.show');
    Route::put('/ess8-assessments/{id}', [ESS8AssessmentController::class, 'update'])->name('ess8-assessments.update');

    // SHI-13 Assessment routes
    Route::post('/shi13-assessments', [SHI13AssessmentController::class, 'store'])->name('shi13-assessments.store');
    Route::get('/shi13-assessments/{patientId}', [SHI13AssessmentController::class, 'show'])->name('shi13-assessments.show');
    Route::put('/shi13-assessments/{id}', [SHI13AssessmentController::class, 'update'])->name('shi13-assessments.update');

    // STOP-BANG Assessment routes
    Route::post('/stopbang-assessments', [STOPBANGAssessmentController::class, 'store'])->name('stopbang-assessments.store');
    Route::get('/stopbang-assessments/{patientId}', [STOPBANGAssessmentController::class, 'show'])->name('stopbang-assessments.show');
    Route::put('/stopbang-assessments/{id}', [STOPBANGAssessmentController::class, 'update'])->name('stopbang-assessments.update');

    // Legacy sleep-assessments route for backward compatibility
    Route::post('/sleep-assessments', [SleepScreeningController::class, 'store'])->name('sleep-assessments.store');

    // Review of Systems routes (consultation-based)
    Route::get('/patients/{patient}/consultations', [\App\Http\Controllers\ReviewOfSystemController::class, 'getConsultations']);
    Route::get('/patients/{patient}/review-of-systems/{consultationType}', [\App\Http\Controllers\ReviewOfSystemController::class, 'getReviewOfSystems']);
    Route::post('/patients/{patient}/review-of-systems', [\App\Http\Controllers\ReviewOfSystemController::class, 'saveReviewOfSystems']);
    Route::post('/patients/{patient}/consultation-date', [\App\Http\Controllers\ReviewOfSystemController::class, 'updateConsultationDate']);

    // Physical examination consultation-based routes
    Route::get('/consultations/{consultation}/physical-examination', [\App\Http\Controllers\PhysicalExaminationController::class, 'getByConsultation'])->name('physical-examination.by-consultation');
    Route::post('/assessments', [AssessmentController::class, 'store'])->name('assessments.store');
    Route::get('/assessments/patient/{patient}', [AssessmentController::class, 'getByPatient'])->name('assessments.byPatient');
    Route::get('/assessments/icd10/search', [AssessmentController::class, 'searchIcd10'])->name('assessments.icd10.search');

    // Comprehensive History Attachments Routes
    Route::get('/patients/{patient}/comprehensive-history/attachments', [ComprehensiveHistoryAttachmentController::class, 'index'])->name('comprehensive-history-attachments.index');
    Route::post('/patients/{patient}/comprehensive-history/attachments', [ComprehensiveHistoryAttachmentController::class, 'store'])->name('comprehensive-history-attachments.store');
    Route::get('/patients/{patient}/comprehensive-history/attachments/{attachment}', [ComprehensiveHistoryAttachmentController::class, 'show'])->name('comprehensive-history-attachments.show');
    Route::delete('/patients/{patient}/comprehensive-history/attachments/{attachment}', [ComprehensiveHistoryAttachmentController::class, 'destroy'])->name('comprehensive-history-attachments.destroy');
    Route::get('/patients/{patient}/comprehensive-history/attachments/{attachment}/download', [ComprehensiveHistoryAttachmentController::class, 'download'])->name('comprehensive-history-attachments.download');
});

Route::middleware('auth')->group(function () {
    // Check if informed consent have already been submitted
    Route::get('/informed-consent/check/{patientId}', [InformedConsentController::class, 'checkConsentSubmitted'])->name('informed_consent.check');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Patient routes
    Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');

    // View Patient
    Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');

    // View Patient Screenings and Assessments
    Route::get('/patients/{patient}/screenings/{consultation?}/{tab?}', [PatientController::class, 'screenings'])->name('patients.screenings');

    // Update diabetes status
    Route::post('/patients/{patient}/update-diabetes-status', [PatientController::class, 'updateDiabetesStatus'])->name('patients.update-diabetes-status');

    // Save notes
    Route::post('/patients/{patient}/save-notes', [PatientController::class, 'saveNotes'])->name('patients.save-notes');

    // Diagnostic routes
    Route::get('/patients/{patient}/diagnostics', [DiagnosticController::class, 'index'])->name('patients.diagnostics');
    Route::post('/diagnostics', [DiagnosticController::class, 'store'])->name('diagnostics.store');
    Route::get('/diagnostics/{id}', [DiagnosticController::class, 'show'])->name('diagnostics.show');
    Route::get('/diagnostic/{diagnosticId}/print', [DiagnosticController::class, 'print'])->name('diagnostics.print');

    Route::post('/social-connectedness', [SocialConnectednessController::class, 'store'])->name('submit.socialConnectedness');
    Route::get('/social-connectedness/{patient_id}', [SocialConnectednessController::class, 'show'])->name('get.socialConnectedness');
    Route::get('/social-connectedness/{patient_id}/data', [SocialConnectednessController::class, 'getDataByPatient'])->name('socialConnectedness.getDataByPatient');

    // Substance use recommendations (backend computed)
    Route::post('/substance-recommendations', [SubstanceRecs::class, 'recommend'])->name('substance.recommendations');
    Route::get('/medicines/search', [MedicineController::class, 'getMedicines'])->name('medicines.search');
    Route::post('/prescription-add', [PrescriptionController::class, 'store'])->name('prescription.store');
    Route::get('/prescription/{prescriptionId}/print', [PrescriptionController::class, 'print']);
    Route::get('/patients/{patient}/prescriptions', [PrescriptionController::class, 'getByPatient'])->name('patients.prescriptions');
    Route::put('/prescriptions/{prescriptionId}/update', [PrescriptionController::class, 'update']);

    // Lifestyle prescription routes
    Route::post('/lifestyle-prescriptions', [LifestylePrescriptionController::class, 'store'])->name('lifestyle-prescriptions.store');
    Route::get('/lifestyle-prescriptions', [LifestylePrescriptionController::class, 'index'])->name('lifestyle-prescriptions.index');
    Route::get('/lifestyle-prescriptions/{lifestylePrescription}', [LifestylePrescriptionController::class, 'show'])->name('lifestyle-prescriptions.show');
    Route::put('/lifestyle-prescriptions/{lifestylePrescription}', [LifestylePrescriptionController::class, 'update'])->name('lifestyle-prescriptions.update');
    Route::delete('/lifestyle-prescriptions/{lifestylePrescription}', [LifestylePrescriptionController::class, 'destroy'])->name('lifestyle-prescriptions.destroy');
    Route::get('/lifestyle-prescriptions/{patientId}/download-pdf', [LifestylePrescriptionController::class, 'downloadPdf'])->name('lifestyle-prescriptions.download-pdf');

    // Medical certificate routes
    Route::post('/medical-certificates', [MedicalCertificateController::class, 'store'])->name('medical-certificates.store');
    Route::get('/patients/{patient}/medical-certificates', [MedicalCertificateController::class, 'getByPatient'])->name('patients.medical-certificates');
    Route::get('/medical-certificates/{id}', [MedicalCertificateController::class, 'show'])->name('medical-certificates.show');
    Route::get('/medical-certificates/{id}/pdf', [MedicalCertificateController::class, 'viewPdf'])->name('medical-certificates.pdf');
    Route::get('/medical-certificates/{id}/download', [MedicalCertificateController::class, 'downloadPdf'])->name('medical-certificates.download');
    Route::put('/medical-certificates/{id}', [MedicalCertificateController::class, 'update'])->name('medical-certificates.update');
    Route::put('/medical-certificates/{id}/revoke', [MedicalCertificateController::class, 'revoke'])->name('medical-certificates.revoke');

    // Medical certificate routes
    Route::post('/medical-certificates', [MedicalCertificateController::class, 'store'])->name('medical-certificates.store');
    Route::get('/patients/{patient}/medical-certificates', [MedicalCertificateController::class, 'getByPatient'])->name('patients.medical-certificates');
    Route::get('/medical-certificates/{id}', [MedicalCertificateController::class, 'show'])->name('medical-certificates.show');
    Route::get('/medical-certificates/{id}/pdf', [MedicalCertificateController::class, 'viewPdf'])->name('medical-certificates.pdf');
    Route::get('/medical-certificates/{id}/download', [MedicalCertificateController::class, 'downloadPdf'])->name('medical-certificates.download');
    Route::put('/medical-certificates/{id}', [MedicalCertificateController::class, 'update'])->name('medical-certificates.update');
    Route::put('/medical-certificates/{id}/revoke', [MedicalCertificateController::class, 'revoke'])->name('medical-certificates.revoke');

    // Referral form routes
    Route::post('/referral-forms', [ReferralFormController::class, 'store'])->name('referral-forms.store');
    Route::post('/referral-forms/preview', [ReferralFormController::class, 'preview'])->name('referral-forms.preview');
    Route::get('/patients/{patient}/referral-forms', [ReferralFormController::class, 'getByPatient'])->name('patients.referral-forms');
    Route::get('/patients/{patient}/referral-statistics', [ReferralFormController::class, 'getStatistics'])->name('patients.referral-statistics');
    Route::get('/referral-forms/{id}', [ReferralFormController::class, 'show'])->name('referral-forms.show');
    Route::get('/referral-forms/{id}/print', [ReferralFormController::class, 'printPdf'])->name('referral-forms.print');
    Route::get('/referral-forms/{id}/download', [ReferralFormController::class, 'downloadPdf'])->name('referral-forms.download');
    Route::put('/referral-forms/{id}', [ReferralFormController::class, 'update'])->name('referral-forms.update');
    Route::put('/referral-forms/{id}/tracking', [ReferralFormController::class, 'updateTracking'])->name('referral-forms.tracking');


    // Debug route
    Route::get('/debug/comprehensive-history/{patient}', function (App\Models\Patient $patient) {
        $comprehensiveHistory = $patient->comprehensiveHistory()->first();
        return [
            'patient_id' => $patient->id,
            'patient_name' => $patient->first_name . ' ' . $patient->last_name,
            'comprehensive_history_exists' => $comprehensiveHistory ? 'Yes' : 'No',
            'comprehensive_history_data' => $comprehensiveHistory
        ];
    });
    // Admin routes for managing pending registrations
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/pending-registrations', [\App\Http\Controllers\Admin\PendingRegistrationController::class, 'index'])->name('pending-registrations.index');
        Route::get('/pending-registrations/{pendingRegistration}', [\App\Http\Controllers\Admin\PendingRegistrationController::class, 'show'])->name('pending-registrations.show');
        Route::post('/pending-registrations/{pendingRegistration}/approve', [\App\Http\Controllers\Admin\PendingRegistrationController::class, 'approve'])->name('pending-registrations.approve');
        Route::post('/pending-registrations/{pendingRegistration}/reject', [\App\Http\Controllers\Admin\PendingRegistrationController::class, 'reject'])->name('pending-registrations.reject');
        Route::delete('/pending-registrations/{pendingRegistration}', [\App\Http\Controllers\Admin\PendingRegistrationController::class, 'destroy'])->name('pending-registrations.destroy');
        Route::get('/api/pending-count', [\App\Http\Controllers\Admin\PendingRegistrationController::class, 'getPendingCount'])->name('pending-registrations.count');
    });
});

require __DIR__ . '/auth.php';
