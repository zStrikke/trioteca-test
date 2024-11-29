@extends('layouts.app')

{{-- Customize layout sections --}}

@section('subtitle', 'Welcome')
@section('content_header_title', 'Home')

{{-- Content body: main page content --}}

@section('content_body')
@forelse ($dwellingLogs as $log)
<div class="timeline">
    <!-- timeline time label -->
    <div class="time-label">
      <span class="bg-red">{{ \Carbon\Carbon::parse($log->created_at) }}</span>
    </div>
    <!-- /.timeline-label -->
    <!-- timeline item -->
    <div>
      <i class="fas fa-user bg-green"></i>
      <div class="timeline-item">
        <span class="time"><i class="fas fa-clock"></i>{{ \Carbon\Carbon::parse($log->created_at)->diffForHumans() }}</span>
        <h3 class="timeline-header no-border"><a href="#">User: {{ $log->user_id }}</a> changed the status from: <b>{{ $log->from }}</b> to: <b>{{ $log->to }}</b></h3>
      </div>
    </div>
    <!-- END timeline item -->
    <div>
      <i class="fas fa-clock bg-gray"></i>
    </div>
  </div>
@empty
    No data
@endforelse

@stop
