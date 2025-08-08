<div id="patient-tab" class="tab-content">
    <!-- Patient Registration Trends -->
    <div class="mb-6">
        <h4 class="text-md font-medium mb-3">Patient Registration Trends</h4>
        <div class="h-48">
            <canvas id="patientsChart"></canvas>
        </div>
    </div>

    <!-- Demographic Charts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-4">
        <!-- Age Distribution -->
        <div>
            <h4 class="text-sm font-medium mb-2">Age Distribution</h4>
            <div class="h-40">
                <canvas id="ageChart"></canvas>
            </div>
        </div>

        <!-- Gender Distribution -->
        <div>
            <h4 class="text-sm font-medium mb-2">Gender Distribution</h4>
            <div class="h-40">
                <canvas id="genderChart"></canvas>
            </div>
        </div>

        <!-- Marital Status -->
        <div>
            <h4 class="text-sm font-medium mb-2">Marital Status</h4>
            <div class="h-40">
                <canvas id="maritalChart"></canvas>
            </div>
        </div>

        <!-- Education Level -->
        <div>
            <h4 class="text-sm font-medium mb-2">Education Level</h4>
            <div class="h-40">
                <canvas id="educationChart"></canvas>
            </div>
        </div>

        <!-- Income Distribution -->
        <div>
            <h4 class="text-sm font-medium mb-2">Monthly Income</h4>
            <div class="h-40">
                <canvas id="incomeChart"></canvas>
            </div>
        </div>

        <!-- Religion Distribution -->
        <div>
            <h4 class="text-sm font-medium mb-2">Religion</h4>
            <div class="h-40">
                <canvas id="religionChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Diabetes Cases -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <h4 class="text-sm font-medium mb-2">Diabetes Cases</h4>
            <div class="h-48">
                <canvas id="diabetesChart"></canvas>
            </div>
        </div>
    </div>
</div>
