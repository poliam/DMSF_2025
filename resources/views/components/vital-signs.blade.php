{{-- Vital Signs Component --}}
@props([
    'tabNumber' => 1,
    'consultation' => null,
    'measurements' => null,
    'patient' => null
])

<div class="measurement-section col-md-6" id="vital-signs-section-{{ $tabNumber }}">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="border-bottom pb-2 mb-0 flex-grow-1 text-black">Vital Signs</h5>
        <button class="edit-mode-btn" data-section="vital-signs" data-tab="{{ $tabNumber }}">
            <i class="fas fa-edit me-1"></i>Edit Mode
        </button>
    </div>
    <div class="column">
        <div class="w-100 mb-3">
            <p class="text-black mb-1"><strong>Temperature (°C)</strong></p>
            <p class="fw-bold editable-measurement" data-field="temperature" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->temperature ?? $patient?->temperature ?? 'N/A' }}
            </p>
        </div>
        <div class="w-100 mb-3">
            <p class="text-black mb-1"><strong>Heart Rate (BPM)</strong></p>
            <p class="fw-bold editable-measurement" data-field="heart_rate" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->heart_rate ?? $patient?->heart_rate ?? 'N/A' }}
            </p>
        </div>
        <div class="w-100 mb-3">
            <p class="text-black mb-1"><strong>O2 Saturation (%)</strong></p>
            <p class="fw-bold editable-measurement" data-field="o2_saturation" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->o2_saturation ?? $patient?->o2_saturation ?? 'N/A' }}
            </p>
        </div>
        <div class="w-100 mb-3">
            <p class="text-black mb-1"><strong>Respiratory Rate (CPM)</strong></p>
            <p class="fw-bold editable-measurement" data-field="respiratory_rate" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->respiratory_rate ?? $patient?->respiratory_rate ?? 'N/A' }}
            </p>
        </div>
        <div class="w-100 mb-3">
            <p class="text-black mb-1"><strong>Blood Pressure (mmHg)</strong></p>
            <p class="fw-bold editable-measurement" data-field="blood_pressure" data-tab="{{ $tabNumber }}" data-consultation-id="{{ $consultation?->id }}">
                {{ $measurements?->blood_pressure ?? $patient?->blood_pressure ?? 'N/A' }}
            </p>
        </div>
    </div>
</div>
