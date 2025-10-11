<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Lifestyle Prescription</title>
	<style>
		@page {
			margin: 0px; /* top right bottom left */
		}

		body {
			font-family: Arial, sans-serif;
			font-size: 13px;
			position: relative;
			padding: 20px 20px 0 20px; /* top right bottom left */
			margin: 0;
		}
		
		/* Create watermark overlay */
		body::before {
			content: '';
			position: fixed;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-image: url('{{ isset($isPdf) && $isPdf ? public_path("images/system_logo.png") : asset("images/system_logo.png") }}');
			background-repeat: repeat;
			background-size: 72px 90px;
			background-position: center;
			opacity: 0.08;
			filter: grayscale(100%) contrast(1.5);
			z-index: -1;
			pointer-events: none;
		}
		.bold-text {
			font-weight: bold;
		}
		.header {
			text-align: center;
			margin-bottom: 10px;
			position: relative;
		}
		.logo-left {
			position: absolute;
			left: 0;
			top: 0;
			width: 80px;
		}
		.logo-right {
			position: absolute;
			right: 0;
			top: 0;
			width: 80px;
		}
		.info-table {
			width: 100%;
			margin-top: 20px;
		}
		.prescription-table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 15px;
		}
		.prescription-table td, .prescription-table th {
			border: 1px solid #ccc;
			padding: 8px;
			vertical-align: top;
		}
		.prescription-table th {
			background-color: #f5f5f5;
			font-weight: bold;
		}
		.category-header {
			background-color: #e8f4f8;
			font-weight: bold;
			text-align: center;
		}
		.recommendation-content {
			padding-left: 10px;
		}
		.footer {
			margin-top: 50px;
			width: 100%;
		}
		.doctor {
			float: right;
			text-align: right;
		}
		.date {
			text-align: right;
		}
		.page-break {
			page-break-before: always;
		}
	</style>
</head>
<body>

	<div class="header">
		<img src="{{ isset($isPdf) && $isPdf ? public_path('images/dmsf_logo_transparent.png') : asset('images/dmsf_logo_transparent.png') }}" class="logo-left">
		<img src="{{ isset($isPdf) && $isPdf ? public_path('images/system_logo.png') : asset('images/system_logo.png') }}" class="logo-right">

		<h3>LANTAW-DABAW PROJECT</h3>
		<h3>A Telelifestyle Monitoring Project for Dabawenyos</h3>
		<p>Medical School Drive, Bajada, Davao City<br>
		Tel No.: (082) 225-7278</p>
		<h4>LIFESTYLE PRESCRIPTION</h4>
		<p class="date">DATE: {{ \Carbon\Carbon::parse($prescription->created_at)->format('F j, Y') }}</p>
		@if($prescription->control_number)
			<p class="date" style="font-weight: bold; margin-top: -10px;">{{ $prescription->control_number }}</p>
		@endif
	</div>
	<hr>
	<table class="info-table">
		<tr>
			<td><strong>NAME:</strong> {{ $prescription->patient->last_name }}, {{ $prescription->patient->first_name }} {{ $prescription->patient->middle_name ?? '' }} </td>
		</tr>
		<tr>
			<td><strong>AGE/SEX:</strong> {{ $prescription->patient->age }} / {{ $prescription->patient->sex ?? $prescription->patient->gender }}</td>
		</tr>
		<tr>
			<td><strong>PRESCRIBING PHYSICIAN:</strong> Maria Angelica C. Plata, RN, MD</td>
		</tr>
	</table>

	<br/>

	@php
		$sections = [
			[
				'title' => 'DIETARY RECOMMENDATIONS',
				'subtitle' => 'Mga Rekomendasyon sa Pagkaon',
				'content' => [
					'diet_type' => $prescription->diet_type,
					'diet_notes' => $prescription->diet_notes
				]
			],
			[
				'title' => 'EXERCISE RECOMMENDATIONS',
				'subtitle' => 'Mga Rekomendasyon sa Ehersisyo',
				'content' => [
					'exercise_type' => $prescription->exercise_type,
					'exercise_notes' => $prescription->exercise_notes
				]
			],
			[
				'title' => 'SLEEP RECOMMENDATIONS',
				'subtitle' => 'Mga Rekomendasyon sa Pagkatulog',
				'content' => [
					'sleep_recommendations' => $prescription->sleep_recommendations
				]
			],
			[
				'title' => 'STRESS MANAGEMENT RECOMMENDATIONS',
				'subtitle' => 'Mga Rekomendasyon sa Pagdumala sa Stress',
				'content' => [
					'stress_recommendations' => $prescription->stress_recommendations
				]
			],
			[
				'title' => 'SOCIAL CONNECTEDNESS RECOMMENDATIONS', 
				'subtitle' => 'Mga Rekomendasyon sa Pakikipag-ugnayan',
				'content' => [
					'social_connectedness_recommendations' => $prescription->social_connectedness_recommendations
				]
			],
			[
				'title' => 'SUBSTANCE AVOIDANCE RECOMMENDATIONS',
				'subtitle' => 'Mga Rekomendasyon sa Pag-iwas sa Bisyo',
				'content' => [
					'substance_avoidance_recommendations' => $prescription->substance_avoidance_recommendations
				]
			]
		];
		
		$sectionsWithContent = array_filter($sections, function($section) {
			return !empty(array_filter($section['content'], function($value) {
				return !empty($value);
			}));
		});
		
		$chunks = array_chunk($sectionsWithContent, 3);
	@endphp

	@foreach($chunks as $chunkIndex => $chunk)
		@if($chunkIndex > 0)
			<div class="page-break"></div>
		@endif
		
		<table class="prescription-table">
			@foreach($chunk as $section)
				<tr>
					<td class="category-header">{{ $section['title'] }}<br><small>({{ $section['subtitle'] }})</small></td>
				</tr>
				<tr>
					<td class="recommendation-content">
						@if($section['title'] === 'DIETARY RECOMMENDATIONS')
							@if($prescription->diet_type)
								<p class="bold-text">• Diet Type / Uri ng Pagkain:</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucwords(str_replace('_', ' ', $prescription->diet_type)) }}</p>
							@endif
							
							@if($prescription->diet_notes)
								<p class="bold-text">• Dietary Notes / Mga Tala sa Pagkain:</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;{!! nl2br(e($prescription->diet_notes)) !!}</p>
							@endif
							
							@if(!$prescription->diet_type && !$prescription->diet_notes)
								<p>&nbsp;&nbsp;&nbsp;&nbsp;<em>Walang partikular na rekomendasyon sa pagkain.</em></p>
							@endif
							
						@elseif($section['title'] === 'EXERCISE RECOMMENDATIONS')
							@if($prescription->exercise_type)
								<p class="bold-text">• Exercise Type / Uri ng Ehersisyo:</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;{{ ucwords(str_replace('_', ' ', $prescription->exercise_type)) }}</p>
							@endif
							
							@if($prescription->exercise_notes)
								<p class="bold-text">• Exercise Notes / Mga Tala sa Ehersisyo:</p>
								<p>&nbsp;&nbsp;&nbsp;&nbsp;{!! nl2br(e($prescription->exercise_notes)) !!}</p>
							@endif
							
							@if(!$prescription->exercise_type && !$prescription->exercise_notes)
								<p>&nbsp;&nbsp;&nbsp;&nbsp;<em>Walang partikular na rekomendasyon sa ehersisyo.</em></p>
							@endif
							
						@elseif($section['title'] === 'SLEEP RECOMMENDATIONS')
							@if($prescription->sleep_recommendations)
								<p>&nbsp;&nbsp;&nbsp;&nbsp;{!! nl2br(e($prescription->sleep_recommendations)) !!}</p>
							@else
								<p>&nbsp;&nbsp;&nbsp;&nbsp;<em>Walang partikular na rekomendasyon sa pagkatulog.</em></p>
							@endif
							
						@elseif($section['title'] === 'STRESS MANAGEMENT RECOMMENDATIONS')
							@if($prescription->stress_recommendations)
								<p>&nbsp;&nbsp;&nbsp;&nbsp;{!! nl2br(e($prescription->stress_recommendations)) !!}</p>
							@else
								<p>&nbsp;&nbsp;&nbsp;&nbsp;<em>Walang partikular na rekomendasyon sa pagdumala sa stress.</em></p>
							@endif
							
						@elseif($section['title'] === 'SOCIAL CONNECTEDNESS RECOMMENDATIONS')
							@if($prescription->social_connectedness_recommendations)
								<p>&nbsp;&nbsp;&nbsp;&nbsp;{!! nl2br(e($prescription->social_connectedness_recommendations)) !!}</p>
							@else
								<p>&nbsp;&nbsp;&nbsp;&nbsp;<em>Walang partikular na rekomendasyon sa pakikipag-ugnayan.</em></p>
							@endif
							
						@elseif($section['title'] === 'SUBSTANCE AVOIDANCE RECOMMENDATIONS')
							@if($prescription->substance_avoidance_recommendations)
								<p>&nbsp;&nbsp;&nbsp;&nbsp;{!! nl2br(e($prescription->substance_avoidance_recommendations)) !!}</p>
							@else
								<p>&nbsp;&nbsp;&nbsp;&nbsp;<em>Walang partikular na rekomendasyon sa pag-iwas sa bisyo.</em></p>
							@endif
						@endif
					</td>
				</tr>
			@endforeach
			
			@if($chunkIndex === count($chunks) - 1)
				<tr>
					<td class="category-header" style="color: #b22222;">IMPORTANTE NGA PANUMDOM</td>
				</tr>
				<tr>
					<td class="recommendation-content">
						<ul style="margin-bottom: 0;">
							<li>Sundon ang mga rekomendasyon sa lifestyle prescription.</li>
							<li>Mag-konsulta sa doktor kung adunay mga pangutana o problema.</li>
							<li>Ingna ang health worker kung naay mga pagbag-o sa imong kahimtang.</li>
							<li>Regular nga pag-follow up alang sa pag-monitor sa imong kalig-on.</li>
						</ul>
					</td>
				</tr>
			@endif
		</table>
	@endforeach

	<div class="footer">
		<div class="doctor">
		   <div style="text-align: right; margin-top: 50px;">
			@php($user = auth()->user())
			@if($user && $user->signature_path)
				<img src="{{ isset($isPdf) && $isPdf ? public_path('storage/' . $user->signature_path) : asset('storage/' . $user->signature_path) }}" style="width: 150px; height: auto;">
			@endif
			<div style="font-weight: bold;">{{ $user?->display_name ?? '' }}</div>
			@if(!empty($user?->license_number))
				<div>License No.: {{ $user->license_number }}</div>
			@endif
		</div>
			LANTAW Project Physician</p>
		</div>
	</div>

</body>
</html>