@extends('backend.layouts.app')

@section('title', __('View Contact Message'))

@section('content')
<div class="row">
    <div class="col-md-10 offset-md-1">
        <x-backend.card>
            <x-slot name="header">
                <div class="d-flex justify-content-between align-items-center w-100">
                    <h5 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-envelope-open mr-2"></i> @lang('Contact Message Details')
                    </h5>
                    <a href="{{ route('admin.messaging.contact.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left mr-1"></i> @lang('Back to Messages')
                    </a>
                </div>
            </x-slot>

            <x-slot name="body">
                <div class="row">
                    <!-- Sender Details Sidebar -->
                    <div class="col-md-4 border-right">
                        <div class="text-center pb-3 border-bottom mb-3">
                            <div class="avatar avatar-xl bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 70px; height: 70px; font-size: 28px;">
                                {{ strtoupper(substr($contact->name ?? 'C', 0, 1)) }}
                            </div>
                            <h5 class="mb-0 font-weight-bold">{{ $contact->name ?? 'Anonymous' }}</h5>
                            <div class="my-1">
                                <span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> Status: Viewed</span>
                            </div>
                            <small class="text-muted"><i class="far fa-clock mr-1"></i> {{ $contact->created_at ? $contact->created_at->format('d M Y, h:i A') : 'N/A' }}</small>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small text-uppercase font-weight-bold mb-1">@lang('Phone Number'):</label>
                            <p class="mb-0 font-weight-bold">
                                @if($contact->phone)
                                    <a href="tel:{{ $contact->phone }}" class="text-dark"><i class="fas fa-phone-alt text-success mr-2"></i> {{ $contact->phone }}</a>
                                @else
                                    <span class="text-muted">Not Provided</span>
                                @endif
                            </p>
                        </div>

                        <div class="mb-3">
                            <label class="text-muted small text-uppercase font-weight-bold mb-1">@lang('Email Address'):</label>
                            <p class="mb-0 font-weight-bold">
                                @if($contact->email)
                                    <a href="mailto:{{ $contact->email }}" class="text-dark"><i class="fas fa-envelope text-primary mr-2"></i> {{ $contact->email }}</a>
                                @else
                                    <span class="text-muted">Not Provided</span>
                                @endif
                            </p>
                        </div>

                        @if(isset($contact->qualification) && $contact->qualification)
                        <div class="mb-3">
                            <label class="text-muted small text-uppercase font-weight-bold mb-1">@lang('Qualification'):</label>
                            <p class="mb-0">{{ $contact->qualification }}</p>
                        </div>
                        @endif

                        @if(isset($contact->course) && $contact->course)
                        <div class="mb-3">
                            <label class="text-muted small text-uppercase font-weight-bold mb-1">@lang('Interested Service'):</label>
                            <p class="mb-0"><span class="badge badge-info">{{ $contact->course }}</span></p>
                        </div>
                        @endif

                        <!-- Quick Action Buttons -->
                        <div class="mt-4 pt-3 border-top">
                            <label class="text-muted small text-uppercase font-weight-bold mb-2">@lang('Quick Actions'):</label>
                            <div class="d-flex flex-column gap-2">
                                @if($contact->phone)
                                    <a href="tel:{{ $contact->phone }}" class="btn btn-sm btn-outline-success mb-2">
                                        <i class="fas fa-phone-alt mr-1"></i> Call Phone
                                    </a>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" target="_blank" class="btn btn-sm btn-outline-success mb-2">
                                        <i class="fab fa-whatsapp mr-1"></i> WhatsApp Message
                                    </a>
                                @endif
                                @if($contact->email)
                                    <a href="mailto:{{ $contact->email }}" class="btn btn-sm btn-outline-primary mb-2">
                                        <i class="fas fa-paper-plane mr-1"></i> Send Reply Email
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Message Body -->
                    <div class="col-md-8 pl-md-4">
                        <div class="card bg-light border-0 shadow-none">
                            <div class="card-header bg-white border-bottom-0 pb-0">
                                <h6 class="font-weight-bold text-dark mb-0"><i class="fas fa-comment-alt text-info mr-2"></i> Message Content:</h6>
                            </div>
                            <div class="card-body">
                                <p class="lead text-dark" style="white-space: pre-line; line-height: 1.7; font-size: 15px;">
                                    {{ $contact->message ?? 'No message content available.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </x-slot>

            <x-slot name="footer">
                <div class="d-flex justify-content-between align-items-center">
                    <a href="{{ route('admin.messaging.contact.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left mr-1"></i> @lang('Back to List')
                    </a>
                    <x-utils.delete-button :href="route('admin.messaging.contact.destroy', $contact)" text="Delete Message" />
                </div>
            </x-slot>
        </x-backend.card>
    </div>
</div>
@endsection
