<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('company')">
                        {{ __('Companie') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('employee')" :active="request()->routeIs('employee')">
                        {{ __('Employee') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>

                        @if (Auth::user()->name != "Admin")
                        <a id = "edit_profile" data-id="{{Auth::user()->emp_id}}" style = "cursor: pointer;" class=" block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                            {{ __('Profile') }}
                        </a>
                        @endif

                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id = "add_companie_modal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Companie Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="companie_form">
                    <input type="hidden" id = "companie_id">
                    <div class = "row my-3 col-sm-12">
                        <label class = "col-sm-3 fs-7 fw-bold mt-1 ps-3">Name</label>
                        <div class = "col-sm-9"><input class = "form-control" type="text" id = "com_name"></div>
                    </div>
                    <div class = "row my-3 col-sm-12">
                        <label class = "col-sm-3 fs-7 fw-bold mt-1 ps-3">Address</label>
                        <div class = "col-sm-9"><input class = "form-control" type="text" id = "com_address"></div>
                    </div>
                    <div class = "row my-3 col-sm-12">
                        <label class = "col-sm-3 fs-7 fw-bold mt-1 ps-3">Email</label>
                        <div class = "col-sm-9"><input class = "form-control" type="text" id = "com_email"></div>
                    </div>
                    <div class = "row my-3 col-sm-12">
                        <input type="hidden" id = "check_logo" value = "0">
                        <input type="hidden" id = "no_logo" value = "{{ url('No_file.png') }}">
                        <input type="hidden" id = "base_logo" value = "">
                        <input type="hidden" id = "base_path" value = "{{ url('storage') }}">
                        <label class = "col-sm-3 fs-7 fw-bold mt-1 ps-3">Logo</label>
                        <div class = "col-sm-9 d-flex">
                            <div class= "col-sm-5">
                                <label class = "btn btn-info mb-1"> <p class = "m-0" id = "logo_btn_text">Add logo</p>
                                    <input class = "form-control" type="file" id = "com_logo" style="display:none">
                                </label>
                                <label id = "clear_logo" class = "btn btn-danger" style="display:none">
                                    Clear Logo
                                </label>
                                <label id = "remove_logo" class = "btn btn-danger" style="display:none">
                                    Remove Logo
                                </label>
                            </div>
                            <div class = "col-sm-7">
                                <img id = "logo_show" class = "w-75 h-100" src="{{ url('No_file.png') }}" alt="" title="" />
                            </div>

                        </div>
                    </div>
                    <div class = "row my-3 col-sm-12">
                        <label class = "col-sm-3 fs-7 fw-bold mt-1 ps-3">Website</label>
                        <div class = "col-sm-9"><input class = "form-control" type="text" id = "com_website"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="text-dark btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="text-dark btn btn-primary company_btn" id = "add_companie">Save changes</button>
                <button type="button" class="text-dark btn btn-primary company_btn" id = "edit_companie">Edit changes</button>
            </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id = "add_employee_modal">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="employee_form">
                    <input type="hidden" id = "employee_id">
                    <div class = "row my-3 col-sm-12">
                        <label class = "col-sm-3 fs-7 fw-bold mt-1 ps-3">First name</label>
                        <div class = "col-sm-9"><input class = "form-control" type="text" id = "emp_fname"></div>
                    </div>
                    <div class = "row my-3 col-sm-12">
                        <label class = "col-sm-3 fs-7 fw-bold mt-1 ps-3">Last name</label>
                        <div class = "col-sm-9"><input class = "form-control" type="text" id = "emp_lname"></div>
                    </div>
                    <div class = "row my-3 col-sm-12">
                        <label class = "col-sm-3 fs-7 fw-bold mt-1 ps-3">Company</label>
                        @php
                            $Companies = App\Models\Employee::getAllCompanie();
                        @endphp
                        <div class = "col-sm-9">
                            <select id="emp_company" class = "form-select">
                                <option></option>
                                @if (count($Companies) > 0)
                                    @foreach ($Companies as $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                @else
                                    <option disabled="disabled">No Data Available</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class = "row my-3 col-sm-12">
                        <label class = "col-sm-3 fs-7 fw-bold mt-1 ps-3">Email</label>
                        <div class = "col-sm-9"><input class = "form-control" type="text" id = "emp_email"></div>
                    </div>
                    <div class = "row my-3 col-sm-12">
                        <label class = "col-sm-3 fs-7 fw-bold mt-1 ps-3">Phone</label>
                        <div class = "col-sm-9"><input class = "form-control" type="text" id = "emp_phone"></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="text-dark btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="text-dark btn btn-primary employee_btn" id = "add_employee">Save changes</button>
                <button type="button" class="text-dark btn btn-primary employee_btn" id = "edit_employee">Edit changes</button>
            </div>
            </div>
        </div>
    </div>
    <script>
        $('#edit_profile').on("click" , function(){
            id = $(this).data('id');
            $.ajax({
                url: '/edit_employee',
                type: "POST",
                data: {id : id},
            }).done(function(data) {
            $("#add_employee_modal").modal("show");
            $(".modal-title").html('Edit Employee Data');
            $(".employee_btn").hide();
            $("#edit_employee").show();
            $("#employee_id").val(id)
            $("#emp_fname").val(data['first_name']);
            $("#emp_lname").val(data['last_name']);
            $("#emp_company").val(data['company']).trigger("change");
            $("#emp_email").val(data['email']);
            $("#emp_phone").val(data['phone']);
            })
        })
        $("#edit_employee").on("click" , function(){
            var formData = new FormData();
            formData.append('id',$("#employee_id").val());
            formData.append('first_name',$("#emp_fname").val());
            formData.append('last_name',$("#emp_lname").val());
            formData.append('company',$("#emp_company").val());
            formData.append('email',$("#emp_email").val());
            formData.append('phone',$("#emp_phone").val());
            $.ajax({
                url: '/update_employee',
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                error: function (request, status, error) {
                    text_error = "";
                    array = JSON.parse(request['responseText'])['errors'];
                    jQuery.each( array, function( key , val ) {
                        jQuery.each( val, function( key , msg ) {
                            text_error += msg +"<br>";
                        });
                    });

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        html: "<p class = 'mx-auto'>"+text_error+"</p>"
                    })

                }
            }).done(function(data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Update Data success',
                    confirmButtonText: 'Continue',
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                })
            })
        })
    </script>
</nav>
