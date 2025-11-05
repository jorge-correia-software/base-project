@props([
    'title' => 'Data Table',
    'emptyIcon' => 'inbox',
    'emptyMessage' => 'No data found.',
    'emptySubtitle' => null,
    'isEmpty' => false,
    'paginator' => null,
    'showCheckboxes' => true,
    'bulkActions' => [],
    'resourceType' => 'item',
    'resourceTypePlural' => 'items',
])

<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <!-- Card Header (always visible) -->
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark border-radius-lg pt-2-5 pb-2-5">
                    <h6 class="text-white text-capitalize ps-3 mb-0">{{ $title }}</h6>
                </div>
            </div>
            <div class="card-body px-0 pb-0">
                @if($isEmpty)
                <div class="text-center py-5">
                    <i class="material-symbols-rounded opacity-5" style="font-size: 64px;">{{ $emptyIcon }}</i>
                    <p class="text-sm text-secondary mt-3 mb-0">{{ $emptyMessage }}</p>
                    @if($emptySubtitle)
                        <p class="text-xs text-secondary mb-0">{{ $emptySubtitle }}</p>
                    @endif
                </div>
                @else
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0" id="dataTable" data-bulk-actions='@json($bulkActions)' data-resource-type="{{ $resourceType }}" data-resource-type-plural="{{ $resourceTypePlural }}">
                        <thead id="tableHeader">
                            <tr id="headerRow">
                                @if($showCheckboxes)
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="selectAll">
                                    </div>
                                </th>
                                @endif
                                {{ $header }}
                            </tr>
                        </thead>
                        <tbody>
                            {{ $slot }}
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
            @if(!$isEmpty && $paginator)
            <div class="card-footer d-flex justify-content-end align-items-center py-3 px-3" style="border-top: 1px solid #dee2e6;">
                {{ $paginator->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
