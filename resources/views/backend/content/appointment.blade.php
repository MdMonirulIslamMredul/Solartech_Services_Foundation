@extends('backend.layouts.app')

@section('title', __('Appointments Management'))

@section('content')
<x-backend.card>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h3 class="card-title font-weight-bold m-0 text-primary">
                <i class="fas fa-calendar-check mr-2"></i> @lang('Appointments Management')
            </h3>
            <div class="appointment-stats mt-2 mt-sm-0">
                @if(method_exists($appointments, 'total'))
                    <span class="badge badge-pill badge-primary px-3 py-2" style="font-size: 13px;">
                        <i class="fas fa-list mr-1"></i> Total: {{ $appointments->total() }}
                    </span>
                @endif
            </div>
        </div>
    </x-slot>

    <x-slot name="body">
        <!-- ── Filter & Search Section ── -->
        <div class="card bg-light border-0 mb-4">
            <div class="card-body py-3">
                <form method="GET" action="{{ route('admin.appointment.search') }}" class="form-inline d-flex align-items-center flex-wrap gap-2">
                    <label class="mr-2 font-weight-bold text-secondary" for="status-filter">
                        <i class="fas fa-filter mr-1"></i> Filter Status:
                    </label>
                    <select name="status" id="status-filter" class="form-control form-control-sm mr-2 rounded" onchange="this.form.submit()">
                        <option value="all" {{ request('status') === 'all' || request('status') === null ? 'selected' : '' }}>
                            All Statuses
                        </option>
                        <option value="connected" {{ request('status') === 'connected' ? 'selected' : '' }}>
                            Connected
                        </option>
                        <option value="not connected" {{ request('status') === 'not connected' ? 'selected' : '' }}>
                            Not Connected
                        </option>
                    </select>
                    @if(request('status') && request('status') !== 'all')
                        <a href="{{ route('admin.appointment.search') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="fas fa-times-circle mr-1"></i> Clear Filter
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- ── Success Alert Message ── -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <!-- ── Appointments Table / Empty State ── -->
        @if($appointments->isEmpty())
            <div class="text-center py-5">
                <div class="mb-3 text-muted" style="font-size: 48px;">
                    <i class="fas fa-calendar-times"></i>
                </div>
                <h5 class="text-secondary font-weight-bold">No Appointments Found</h5>
                <p class="text-muted">There are currently no appointment records matching your selection.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="thead-light">
                        <tr>
                            <th width="50" class="text-center">#</th>
                            <th>Client Info</th>
                            <th>Location / Address</th>
                            <th>Service Requested</th>
                            <th>Date & Time</th>
                            <th class="text-center">Status</th>
                            <th class="text-center" width="220">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $index => $appointment)
                            @php
                                $slNumber = method_exists($appointments, 'firstItem') ? ($appointments->firstItem() + $index) : ($index + 1);
                                $isConnected = ($appointment->status === 'connected');
                            @endphp
                            <tr>
                                <td class="text-center font-weight-bold align-middle">{{ $slNumber }}</td>
                                <td class="align-middle">
                                    <div class="font-weight-bold text-dark">{{ $appointment->name }}</div>
                                    @if($appointment->phone)
                                        <small class="text-muted">
                                            <a href="tel:{{ $appointment->phone }}" class="text-primary">
                                                <i class="fas fa-phone-alt mr-1"></i> {{ $appointment->phone }}
                                            </a>
                                        </small>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    <span class="text-dark">{{ $appointment->car_model ?? 'N/A' }}</span>
                                </td>
                                <td class="align-middle">
                                    @if($appointment->service_type)
                                        <span class="badge badge-info px-2 py-1">{{ $appointment->service_type }}</span>
                                    @else
                                        <span class="text-muted">General Service</span>
                                    @endif
                                </td>
                                <td class="align-middle">
                                    @if($appointment->date)
                                        <div class="font-weight-bold text-dark">
                                            <i class="far fa-calendar-alt text-primary mr-1"></i>
                                            {{ \Carbon\Carbon::parse($appointment->date)->format('d M Y') }}
                                        </div>
                                    @endif
                                    @if($appointment->time)
                                        <small class="text-muted">
                                            <i class="far fa-clock text-info mr-1"></i>
                                            {{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}
                                        </small>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    @if($isConnected)
                                        <span class="badge badge-success px-2 py-1">
                                            <i class="fas fa-check-circle mr-1"></i> Connected
                                        </span>
                                    @else
                                        <span class="badge badge-warning text-dark px-2 py-1">
                                            <i class="fas fa-clock mr-1"></i> Not Connected
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <!-- View Details Modal Trigger -->
                                        <button type="button" class="btn btn-info btn-sm mr-1 rounded" data-toggle="modal" data-target="#appointmentModal{{ $appointment->id }}" title="View Details">
                                            <i class="fas fa-eye mr-1"></i> View
                                        </button>

                                        <!-- Status Update Forms -->
                                        @if(!$isConnected)
                                            <form action="{{ route('admin.appointment.updateStatus', $appointment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="connected">
                                                <button type="submit" class="btn btn-success btn-sm rounded" title="Mark as Connected">
                                                    <i class="fas fa-check"></i> Connect
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.appointment.updateStatus', $appointment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="status" value="not connected">
                                                <button type="submit" class="btn btn-secondary btn-sm rounded" title="Mark as Not Connected">
                                                    <i class="fas fa-undo"></i> Reset
                                                </button>
                                            </form>
                                        @endif
                                    </div>

                                    <!-- ── View Appointment Modal ── -->
                                    <div class="modal fade text-left" id="appointmentModal{{ $appointment->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel{{ $appointment->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title font-weight-bold" id="modalLabel{{ $appointment->id }}">
                                                        <i class="fas fa-calendar-check mr-2"></i> Appointment Details #{{ $appointment->id }}
                                                    </h5>
                                                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body p-4">
                                                    <div class="row g-3">
                                                        <!-- Client Name -->
                                                        <div class="col-md-6 mb-3">
                                                            <label class="text-muted small text-uppercase font-weight-bold mb-1">Client Name:</label>
                                                            <div class="font-weight-bold text-dark h6 mb-0">{{ $appointment->name }}</div>
                                                        </div>

                                                        <!-- Phone Number -->
                                                        <div class="col-md-6 mb-3">
                                                            <label class="text-muted small text-uppercase font-weight-bold mb-1">Phone Number:</label>
                                                            <div>
                                                                <a href="tel:{{ $appointment->phone }}" class="font-weight-bold text-primary h6 mb-0">
                                                                    <i class="fas fa-phone-alt mr-1"></i> {{ $appointment->phone }}
                                                                </a>
                                                            </div>
                                                        </div>

                                                        <!-- Address / Location -->
                                                        <div class="col-md-6 mb-3">
                                                            <label class="text-muted small text-uppercase font-weight-bold mb-1">Cleaning Address / Location:</label>
                                                            <div class="font-weight-bold text-dark mb-0">
                                                                <i class="fas fa-map-marker-alt text-danger mr-1"></i> {{ $appointment->car_model ?? 'Not Specified' }}
                                                            </div>
                                                        </div>

                                                        <!-- Service Type -->
                                                        <div class="col-md-6 mb-3">
                                                            <label class="text-muted small text-uppercase font-weight-bold mb-1">Service Type:</label>
                                                            <div>
                                                                <span class="badge badge-info px-3 py-2 font-weight-bold">
                                                                    <i class="fas fa-concierge-bell mr-1"></i> {{ $appointment->service_type ?? 'General Service' }}
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <!-- Preferred Date -->
                                                        <div class="col-md-6 mb-3">
                                                            <label class="text-muted small text-uppercase font-weight-bold mb-1">Preferred Date:</label>
                                                            <div class="font-weight-bold text-dark mb-0">
                                                                <i class="far fa-calendar-alt text-primary mr-1"></i>
                                                                {{ $appointment->date ? \Carbon\Carbon::parse($appointment->date)->format('l, d F Y') : 'N/A' }}
                                                            </div>
                                                        </div>

                                                        <!-- Preferred Time -->
                                                        <div class="col-md-6 mb-3">
                                                            <label class="text-muted small text-uppercase font-weight-bold mb-1">Preferred Time:</label>
                                                            <div class="font-weight-bold text-dark mb-0">
                                                                <i class="far fa-clock text-info mr-1"></i>
                                                                {{ $appointment->time ? \Carbon\Carbon::parse($appointment->time)->format('h:i A') : 'N/A' }}
                                                            </div>
                                                        </div>

                                                        <!-- Current Status -->
                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-muted small text-uppercase font-weight-bold mb-1">Status:</label>
                                                            <div>
                                                                @if($isConnected)
                                                                    <span class="badge badge-success px-3 py-2" style="font-size: 13px;">
                                                                        <i class="fas fa-check-circle mr-1"></i> Connected
                                                                    </span>
                                                                @else
                                                                    <span class="badge badge-warning text-dark px-3 py-2" style="font-size: 13px;">
                                                                        <i class="fas fa-clock mr-1"></i> Not Connected
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <!-- Additional Notes -->
                                                        <div class="col-md-12 mb-3">
                                                            <label class="text-muted small text-uppercase font-weight-bold mb-1">Additional Notes / Special Instructions:</label>
                                                            <div class="card bg-light border-0 p-3 mb-0">
                                                                <p class="mb-0 text-dark" style="white-space: pre-line;">
                                                                    {{ $appointment->note ?? 'No additional notes provided by client.' }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <!-- Quick Communication Bar -->
                                                        <div class="col-md-12">
                                                            <label class="text-muted small text-uppercase font-weight-bold mb-2">Quick Response Actions:</label>
                                                            <div class="d-flex gap-2 flex-wrap">
                                                                @if($appointment->phone)
                                                                    <a href="tel:{{ $appointment->phone }}" class="btn btn-sm btn-outline-success mr-2 mb-2">
                                                                        <i class="fas fa-phone-alt mr-1"></i> Call Client
                                                                    </a>
                                                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $appointment->phone) }}" target="_blank" class="btn btn-sm btn-outline-success mr-2 mb-2">
                                                                        <i class="fab fa-whatsapp mr-1"></i> WhatsApp Message
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer bg-light">
                                                    @if(!$isConnected)
                                                        <form action="{{ route('admin.appointment.updateStatus', $appointment->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="status" value="connected">
                                                            <button type="submit" class="btn btn-success">
                                                                <i class="fas fa-check mr-1"></i> Mark as Connected
                                                            </button>
                                                        </form>
                                                    @else
                                                        <form action="{{ route('admin.appointment.updateStatus', $appointment->id) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            <input type="hidden" name="status" value="not connected">
                                                            <button type="submit" class="btn btn-secondary">
                                                                <i class="fas fa-undo mr-1"></i> Mark as Not Connected
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ── End View Appointment Modal ── -->

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-4 d-flex justify-content-end">
                {{ $appointments->links() }}
            </div>
        @endif
    </x-slot>
</x-backend.card>

<style>
    .appointment-stats .badge {
        font-size: 13px;
        padding: 8px 14px;
    }

    .table td, .table th {
        vertical-align: middle !important;
    }

    .modal-header .close {
        outline: none;
        opacity: 0.9;
    }

    .modal-header .close:hover {
        opacity: 1;
    }
</style>
@endsection