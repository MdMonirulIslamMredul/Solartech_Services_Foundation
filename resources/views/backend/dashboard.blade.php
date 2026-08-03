@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
@php
    $totalAppointments = DB::table('appointments')->count();
    $connectedAppointments = DB::table('appointments')->where('status', 'connected')->count();
    $pendingAppointments = DB::table('appointments')->where(function($q){
        $q->whereNull('status')->orWhere('status', 'not connected');
    })->count();

    $contactTable = Schema::hasTable('contacts') ? 'contacts' : 'contact';
    $totalContacts = DB::table($contactTable)->count();
    $hasIsView = Schema::hasColumn($contactTable, 'is_view');
    $unreadContacts = $hasIsView 
        ? DB::table($contactTable)->where('is_view', 0)->count() 
        : 0;

    $totalServices = Schema::hasTable('services') ? DB::table('services')->where('is_active', 1)->count() : 0;
    $totalSliders = Schema::hasTable('sliders') ? DB::table('sliders')->where('is_active', 1)->count() : 0;

    $recentAppointments = DB::table('appointments')->latest()->limit(5)->get();
    $recentContacts = DB::table($contactTable)->latest()->limit(5)->get();
@endphp

<div class="dashboard-wrapper">
    <!-- ── Welcome Hero Banner ── -->
    <div class="card border-0 shadow-sm mb-4 text-white overflow-hidden" style="background: linear-gradient(135deg, #111D5E 0%, #29A9E0 100%); border-radius: 16px;">
        <div class="card-body p-4 position-relative">
            <div class="row align-items-center">
                <div class="col-md-8 mb-3 mb-md-0">
                    <span class="badge badge-light text-primary font-weight-bold px-3 py-1 mb-2" style="border-radius: 50px; font-size: 11px;">
                        <i class="fas fa-sparkles text-warning mr-1"></i> Admin Portal
                    </span>
                    <h2 class="font-weight-bold mb-1">Welcome back, {{ $logged_in_user->name ?? 'Admin' }}! 👋</h2>
                    <p class="mb-0 text-white-50" style="font-size: 15px;">
                        Here is an overview of your cleaning service appointments, customer messages, and business performance today.
                    </p>
                </div>
                <div class="col-md-4 text-md-right">
                    <a href="{{ route('admin.appointment.search') }}" class="btn btn-light btn-sm text-primary font-weight-bold shadow-sm px-3 py-2 mr-2" style="border-radius: 10px;">
                        <i class="fas fa-calendar-alt mr-1"></i> Appointments
                    </a>
                    <a href="{{ route('admin.messaging.contact.index') }}" class="btn btn-outline-light btn-sm font-weight-bold px-3 py-2" style="border-radius: 10px;">
                        <i class="fas fa-envelope mr-1"></i> Messages
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ── KPI Summary Cards Row ── -->
    <div class="row">
        <!-- Total Appointments Card -->
        <div class="col-lg-3 col-sm-6 col-12 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 5px solid #29A9E0 !important;">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small font-weight-bold text-uppercase">Total Appointments</span>
                            <h3 class="font-weight-bold mb-0 text-dark mt-1">{{ number_format($totalAppointments) }}</h3>
                            <small class="text-info font-weight-bold">
                                <i class="fas fa-clock mr-1"></i> {{ $pendingAppointments }} Pending Response
                            </small>
                        </div>
                        <div class="icon-circle bg-light-primary text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; font-size: 22px;">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Connected Appointments Card -->
        <div class="col-lg-3 col-sm-6 col-12 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 5px solid #10b981 !important;">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small font-weight-bold text-uppercase">Connected Clients</span>
                            <h3 class="font-weight-bold mb-0 text-dark mt-1">{{ number_format($connectedAppointments) }}</h3>
                            <small class="text-success font-weight-bold">
                                <i class="fas fa-check-circle mr-1"></i> Confirmed Bookings
                            </small>
                        </div>
                        <div class="icon-circle bg-light-success text-success rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; font-size: 22px;">
                            <i class="fas fa-user-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Messages Card -->
        <div class="col-lg-3 col-sm-6 col-12 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 5px solid #f59e0b !important;">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small font-weight-bold text-uppercase">Contact Messages</span>
                            <h3 class="font-weight-bold mb-0 text-dark mt-1">{{ number_format($totalContacts) }}</h3>
                            @if($unreadContacts > 0)
                                <small class="text-danger font-weight-bold">
                                    <i class="fas fa-envelope-open-text mr-1"></i> {{ $unreadContacts }} Unread Messages
                                </small>
                            @else
                                <small class="text-muted">
                                    <i class="fas fa-check-double mr-1"></i> All Messages Read
                                </small>
                            @endif
                        </div>
                        <div class="icon-circle bg-light-warning text-warning rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; font-size: 22px;">
                            <i class="fas fa-comments"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Services Card -->
        <div class="col-lg-3 col-sm-6 col-12 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 14px; border-left: 5px solid #8b5cf6 !important;">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="text-muted small font-weight-bold text-uppercase">Active Services</span>
                            <h3 class="font-weight-bold mb-0 text-dark mt-1">{{ number_format($totalServices) }}</h3>
                            <small class="text-purple font-weight-bold">
                                <i class="fas fa-concierge-bell mr-1"></i> Offered Services
                            </small>
                        </div>
                        <div class="icon-circle bg-light-purple text-purple rounded-circle d-flex align-items-center justify-content-center" style="width: 52px; height: 52px; font-size: 22px;">
                            <i class="fas fa-broom"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ── Main Dashboard Data Row ── -->
    <div class="row">
        <!-- Recent Appointments Table Card -->
        <div class="col-lg-7 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
                <div class="card-header bg-white border-bottom-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title font-weight-bold m-0 text-dark">
                        <i class="fas fa-calendar-check text-primary mr-2"></i> Recent Appointments
                    </h5>
                    <a href="{{ route('admin.appointment.search') }}" class="btn btn-sm btn-light text-primary font-weight-bold">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    @if($recentAppointments->isEmpty())
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-info-circle mb-2" style="font-size: 28px;"></i>
                            <p class="mb-0">No appointments recorded yet.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Client</th>
                                        <th>Service</th>
                                        <th>Date & Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentAppointments as $apt)
                                        <tr>
                                            <td>
                                                <div class="font-weight-bold text-dark">{{ $apt->name ?? 'Unknown' }}</div>
                                                @if($apt->phone)
                                                    <small class="text-muted"><i class="fas fa-phone-alt mr-1"></i> {{ $apt->phone }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge badge-info px-2 py-1">{{ $apt->service_type ?? 'General' }}</span>
                                            </td>
                                            <td>
                                                @if($apt->date)
                                                    <small class="d-block font-weight-bold text-dark">
                                                        <i class="far fa-calendar-alt text-primary mr-1"></i>
                                                        {{ \Carbon\Carbon::parse($apt->date)->format('d M Y') }}
                                                    </small>
                                                @endif
                                                @if($apt->time)
                                                    <small class="text-muted">
                                                        <i class="far fa-clock mr-1"></i>
                                                        {{ \Carbon\Carbon::parse($apt->time)->format('h:i A') }}
                                                    </small>
                                                @endif
                                            </td>
                                            <td>
                                                @if($apt->status === 'connected')
                                                    <span class="badge badge-success px-2 py-1"><i class="fas fa-check mr-1"></i> Connected</span>
                                                @else
                                                    <span class="badge badge-warning text-dark px-2 py-1"><i class="fas fa-clock mr-1"></i> Pending</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Contact Messages Card -->
        <div class="col-lg-5 mb-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 16px;">
                <div class="card-header bg-white border-bottom-0 py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title font-weight-bold m-0 text-dark">
                        <i class="fas fa-envelope text-warning mr-2"></i> Recent Messages
                    </h5>
                    <a href="{{ route('admin.messaging.contact.index') }}" class="btn btn-sm btn-light text-warning font-weight-bold">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                <div class="card-body p-0">
                    @if($recentContacts->isEmpty())
                        <div class="text-center py-4 text-muted">
                            <i class="fas fa-inbox mb-2" style="font-size: 28px;"></i>
                            <p class="mb-0">No contact messages received yet.</p>
                        </div>
                    @else
                        <div class="list-group list-group-flush">
                            @foreach($recentContacts as $msg)
                                @php
                                    $isRead = isset($msg->is_view) && $msg->is_view == 1;
                                @endphp
                                <a href="{{ route('admin.messaging.contact.show', $msg->id) }}" class="list-group-item list-group-item-action p-3 border-bottom">
                                    <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                                        <h6 class="mb-0 font-weight-bold text-dark">
                                            {{ $msg->name ?? 'Visitor' }}
                                        </h6>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($msg->created_at)->diffForHumans() }}
                                        </small>
                                    </div>
                                    <p class="mb-1 text-muted small text-truncate" style="max-width: 320px;">
                                        {{ $msg->message ?? 'No message body...' }}
                                    </p>
                                    <div class="d-flex align-items-center gap-2 mt-1">
                                        @if($msg->phone)
                                            <span class="badge badge-light text-dark mr-2"><i class="fas fa-phone-alt text-success mr-1"></i> {{ $msg->phone }}</span>
                                        @endif
                                        @if($isRead)
                                            <span class="badge badge-success"><i class="fas fa-check-double mr-1"></i> Viewed</span>
                                        @else
                                            <span class="badge badge-danger"><i class="fas fa-envelope mr-1"></i> New</span>
                                        @endif
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-light-primary { background-color: rgba(41, 169, 224, 0.12) !important; }
    .bg-light-success { background-color: rgba(16, 185, 129, 0.12) !important; }
    .bg-light-warning { background-color: rgba(245, 158, 11, 0.12) !important; }
    .bg-light-purple { background-color: rgba(139, 92, 246, 0.12) !important; }

    .text-purple { color: #8b5cf6 !important; }

    .table td, .table th {
        vertical-align: middle;
        padding: 0.85rem 1rem;
    }

    .list-group-item:hover {
        background-color: #f8fafc;
    }
</style>
@endsection
