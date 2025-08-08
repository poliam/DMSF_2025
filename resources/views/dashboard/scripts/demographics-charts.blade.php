{{-- Demographics Charts Configuration --}}
<script>
// Demographics Charts Configuration
const demographicsCharts = {
    // Age Distribution Chart
    initAgeChart: function(data) {
        try {
            const ctx = document.getElementById('ageChart');
            if (!ctx) {
                return;
            }
            new Chart(ctx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: ['18-30', '31-45', '46-60', '60+'],
                    datasets: [{
                        label: 'Patients',
                        data: [
                            data.age_18_30 || 0,
                            data.age_31_45 || 0,
                            data.age_46_60 || 0,
                            data.age_60_plus || 0
                        ],
                        backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { 
                                boxWidth: 12, 
                                fontSize: 10,
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });
        } catch (error) {
        }
    },

    // Gender Distribution Chart
    initGenderChart: function(data) {
        try {
            const ctx = document.getElementById('genderChart');
            if (!ctx) {
                return;
            }
            new Chart(ctx.getContext('2d'), {
                type: 'pie',
                data: {
                    labels: ['Male', 'Female', 'Other'],
                    datasets: [{
                        label: 'Patients',
                        data: [
                            data.male || 0,
                            data.female || 0,
                            data.other || 0
                        ],
                        backgroundColor: ['#3B82F6', '#EC4899', '#6B7280'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { 
                                boxWidth: 12, 
                                fontSize: 10,
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });
        } catch (error) {
        }
    },

    // Marital Status Chart
    initMaritalChart: function(data) {
        try {
            const ctx = document.getElementById('maritalChart');
            if (!ctx) {
                return;
            }
            new Chart(ctx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(data.maritalStatus || {}),
                    datasets: [{
                        label: 'Patients',
                        data: Object.values(data.maritalStatus || {}),
                        backgroundColor: ['#10B981', '#F59E0B', '#EF4444', '#8B5CF6', '#06B6D4'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { 
                                boxWidth: 12, 
                                fontSize: 10,
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });
        } catch (error) {
        }
    },

    // Education Level Chart
    initEducationChart: function(data) {
        try {
            const ctx = document.getElementById('educationChart');
            if (!ctx) {
                return;
            }
            new Chart(ctx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: Object.keys(data.education || {}),
                    datasets: [{
                        label: 'Patients',
                        data: Object.values(data.education || {}),
                        backgroundColor: ['#8B5CF6', '#EC4899', '#F59E0B', '#EF4444', '#06B6D4', '#10B981'],
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            display: true,
                            title: {
                                display: true,
                                text: 'Number of Patients',
                                font: { size: 10 }
                            },
                            ticks: { font: { size: 9 } }
                        },
                        x: { 
                            display: true,
                            ticks: { font: { size: 9 } }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        } catch (error) {
        }
    },

    // Income Distribution Chart
    initIncomeChart: function(data) {
        try {
            const ctx = document.getElementById('incomeChart');
            if (!ctx) {
                return;
            }
            new Chart(ctx.getContext('2d'), {
                type: 'bar',
                data: {
                    labels: Object.keys(data.income || {}),
                    datasets: [{
                        label: 'Patients',
                        data: Object.values(data.income || {}),
                        backgroundColor: ['#FB7185', '#FBBF24', '#34D399', '#60A5FA', '#A78BFA', '#F472B6'],
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            display: true,
                            title: {
                                display: true,
                                text: 'Number of Patients',
                                font: { size: 10 }
                            },
                            ticks: { font: { size: 9 } }
                        },
                        x: { 
                            display: true,
                            ticks: { font: { size: 9 } }
                        }
                    },
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        } catch (error) {
        }
    },

    // Religion Distribution Chart
    initReligionChart: function(data) {
        try {
            const ctx = document.getElementById('religionChart');
            if (!ctx) {
                return;
            }
            new Chart(ctx.getContext('2d'), {
                type: 'pie',
                data: {
                    labels: Object.keys(data.religion || {}),
                    datasets: [{
                        label: 'Patients',
                        data: Object.values(data.religion || {}),
                        backgroundColor: ['#8B5CF6', '#EC4899', '#F59E0B', '#10B981', '#3B82F6', '#EF4444'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { 
                                boxWidth: 12, 
                                fontSize: 10,
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });
        } catch (error) {
        }
    },

    // Patient Registration Trends Chart
    initPatientsChart: function(data) {
        try {
            const ctx = document.getElementById('patientsChart');
            if (!ctx) {
                return;
            }
            new Chart(ctx.getContext('2d'), {
                type: 'line',
                data: {
                    labels: data.months || [],
                    datasets: [{
                        label: 'New Patients',
                        data: data.counts || [],
                        borderColor: '#3B82F6',
                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: { 
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Patients',
                                font: { size: 10 }
                            },
                            ticks: { font: { size: 9 } }
                        },
                        x: { 
                            title: {
                                display: true,
                                text: 'Month',
                                font: { size: 10 }
                            },
                            ticks: { font: { size: 9 } }
                        }
                    },
                    plugins: {
                        legend: { 
                            display: true,
                            position: 'top',
                            labels: { font: { size: 10 } }
                        }
                    }
                }
            });
        } catch (error) {
        }
    },

    // Diabetes Cases Chart
    // Diabetes Status Distribution Chart
    initDiabetesChart: function(data) {
        try {
            const ctx = document.getElementById('diabetesChart');
            if (!ctx) {
                return;
            }
            
            const diabetesStatus = data.diabetesStatus || {};
            
            new Chart(ctx.getContext('2d'), {
                type: 'doughnut',
                data: {
                    labels: [
                        'Not Diabetic', 
                        'Prediabetes', 
                        'DM Type I', 
                        'DM Type II', 
                        'Gestational DM', 
                        'Other Hyperglycemic', 
                        'Pending'
                    ],
                    datasets: [{
                        label: 'Patients',
                        data: [
                            diabetesStatus['Not Diabetic'] || 0,
                            diabetesStatus['Prediabetes'] || 0,
                            diabetesStatus['DM Type I'] || 0,
                            diabetesStatus['DM Type II'] || 0,
                            diabetesStatus['Gestational DM'] || 0,
                            diabetesStatus['Other Hyperglycemic States'] || 0,
                            diabetesStatus['Pending'] || 0
                        ],
                        backgroundColor: [
                            '#10B981', // Not Diabetic - Green
                            '#F59E0B', // Prediabetes - Amber
                            '#EF4444', // DM Type I - Red
                            '#DC2626', // DM Type II - Dark Red
                            '#F97316', // Gestational DM - Orange
                            '#8B5CF6', // Other Hyperglycemic - Purple
                            '#6B7280'  // Pending - Gray
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: { 
                                boxWidth: 12, 
                                fontSize: 10,
                                font: { size: 10 }
                            }
                        }
                    }
                }
            });
        } catch (error) {
        }
    },

    // Initialize all demographic charts
    initAll: function(dashboardData) {
        this.initAgeChart(dashboardData);
        this.initGenderChart(dashboardData);
        this.initMaritalChart(dashboardData);
        this.initEducationChart(dashboardData);
        this.initIncomeChart(dashboardData);
        this.initReligionChart(dashboardData);
        this.initPatientsChart(dashboardData.patientTrends || {});
        this.initDiabetesChart(dashboardData);
    }
};
</script>
