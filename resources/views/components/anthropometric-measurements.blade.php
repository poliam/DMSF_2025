{{-- Anthropometric Measurements Component --}}
@props([
    'tabNumber' => 1,
    'consultation' => null,
    'measurements' => null,
    'patient' => null
])

<div class="measurement-section col-md-6" id="anthropometric-section-{{ $tabNumber }}">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="border-bottom pb-2 mb-0 flex-grow-1 text-black">Anthropometric Measurements</h5>
        <button class="edit-mode-btn" data-section="anthropometric" data-tab="{{ $tabNumber }}">
            <i class="fas fa-edit me-1"></i>Edit Mode
        </button>
    </div>
    <div class="column">
        <div class="w-100 mb-3">
            <p class="text-black mb-1"><strong> Height (m) </strong></p>
            <p class="fw-bold editable-measurement" data-field="height" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->getHeightInMeters() ?? $patient?->getHeightInMeters() ?? 'N/A' }}
            </p>
        </div>
        <div class="w-100 mb-3">
            <p class="text-black mb-1"><strong>Weight (kg)</strong></p>
            <p class="fw-bold editable-measurement" data-field="weight_kg" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->weight_kg ?? $patient?->weight_kg ?? 'N/A' }}
            </p>
        </div>
        <!-- <div class="w-100 mb-3">
            <p class="text-black mb-1"><strong>BMI (kg/m²)</strong></p>
            <p class="fw-bold" id="bmi-tab{{ $tabNumber }}">
                {{ $measurements?->calculateBMI() ?? $patient?->calculateBMI() ?? 'N/A' }}
            </p>
        </div> -->
        <div class="w-100 mb-3">
            <p class="text-black mb-1"><strong>Waist Circumference (cm)</strong></p>
            <p class="fw-bold editable-measurement" data-field="waist_circumference" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->waist_circumference ?? $patient?->waist_circumference ?? 'N/A' }}
            </p>
        </div>
        <div class="w-100 mb-3">
            <p class="text-black mb-1"><strong>Hip Circumference (cm)</strong></p>
            <p class="fw-bold editable-measurement" data-field="hip_circumference" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->hip_circumference ?? $patient?->hip_circumference ?? 'N/A' }}
            </p>
        </div>
        <div class="w-100 mb-3">
            <p class="text-black mb-1"><strong>Neck Circumference (cm)</strong></p>
            <p class="fw-bold editable-measurement" data-field="neck_circumference" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->neck_circumference ?? $patient?->neck_circumference ?? 'N/A' }}
            </p>
        </div>
    </div>
</div>
