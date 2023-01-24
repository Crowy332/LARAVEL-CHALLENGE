<x-app-layout>
    <x-slot name="header">
        <h2 class="float-start font-semibold mt-1 text-xl text-gray-800 leading-tight">
            {{ __('Companie') }}
        </h2>
        <button class = "float-end btn btn-primary" id = "add_companie_btn"> {{ __('Add Companie') }}</button>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class = "datatable" id = "companie_table">
                        <div class = "table-responsive" >
                            <table class="table table-bordered mb-5">
                                <thead>
                                    <tr class="table-success">
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Logo</th>
                                        <th scope="col">Website</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($companie as $data)
                                    <tr class = "text-start">
                                        <th class = "text-center"scope="row">{{ $data->id }}</th>
                                        <td>{{ $data->name }}</td>
                                        <td>{{ $data->address }}</td>
                                        <td>{{ $data->email }}</td>
                                        <td>{{ $data->logo }}</td>
                                        <td>{{ $data->website }}</td>
                                        <td class = "d-flex justify-content-center gap-2">
                                            <button class = "btn btn-warning edit_btn" data-id = "{{ $data->id }}"><i class="fa fa-pencil-square-o"></i></button>
                                            <button class = "btn btn-danger delete_btn" data-id = "{{ $data->id }}"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">
                            {!! $companie->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="footer">
        <script src="{{URL::asset('js/company.js')}}"></script>
    </x-slot>
</x-app-layout>
