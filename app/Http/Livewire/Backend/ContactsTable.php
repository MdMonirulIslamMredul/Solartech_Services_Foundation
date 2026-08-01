<?php

namespace App\Http\Livewire\Backend;

use App\Domains\Contacts\Models\Contact;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;

class ContactsTable extends DataTableComponent
{
    /**
     * @return Builder
     */
    public function query(): Builder
    {
        return contact::with('user:id')->latest();
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),
            Column::make('E-mail', 'email')
                ->searchable(),
            Column::make('Phone', 'phone')
                ->searchable(),
            Column::make('Message', 'message')
                ->searchable(),
            Column::make('Status', 'is_view')
                ->format(function ($value, $column, $row) {
                    if ($row->is_view == 1) {
                        return '<span class="badge badge-success px-2 py-1"><i class="fas fa-check-circle mr-1"></i> Viewed</span>';
                    }
                    return '<span class="badge badge-warning text-dark px-2 py-1"><i class="fas fa-envelope mr-1"></i> Unread</span>';
                })
                ->asHtml(),
            Column::make(__('Action'), 'action')
                ->format(function ($value, $column, $row) {
                    return view('backend.messaging.contact.includes.actions')->withcontact($row);
                }),
        ];
    }
}
