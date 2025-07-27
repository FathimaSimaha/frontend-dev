<x-layout>
    <div class="dashboard-main-body">
        <x-content-header title="Create Vehicle" breadcrumb="AI" breadcrumb-url="index.html" />

        {{-- Example: Using the components in your vehicle form --}}
        <form id="vehicleCreationForm" action="/submit-vehicle" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Basic Information Card --}}
            <x-form.card title="Basic Information" spacing="">
                <div class="row gy-3">
                    <x-form.input name="vehicle_number" label="Vehicle Number" required />

                    <div class="col-12">
                        <div class="row">
                            <x-form.select name="vehicle_type" label="Vehicle Type" :options="[
                                'car' => 'Car',
                                'van' => 'Van',
                                'truck' => 'Truck',
                                'motorcycle' => 'Motorcycle',
                            ]"
                                placeholder="Choose vehicle type..." col-class="col-6" required />

                            <x-form.select name="model" label="Model" :options="[
                                'bmw' => 'BMW',
                                'toyota' => 'Toyota',
                                'audi' => 'Audi',
                                'honda' => 'Honda',
                                'ford' => 'Ford',
                            ]" placeholder="Choose model..."
                                col-class="col-6" required />
                        </div>
                    </div>

                    <x-form.input name="brand" label="Brand" required />

                    <div class="col-12">
                        <div class="row">
                            <x-form.input name="manufactured_date" label="Manufactured Date" type="date"
                                col-class="col-6" required />

                            <x-form.input name="registered_date" label="Registered Date" type="date"
                                col-class="col-6" required />
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <x-form.input name="color" label="Color" col-class="col-6" required />

                            <x-form.select name="fuel_type" label="Fuel Type" :options="[
                                'petrol' => 'Petrol',
                                'diesel' => 'Diesel',
                                'hybrid' => 'Hybrid',
                                'electric' => 'Electric',
                            ]"
                                placeholder="Choose fuel type..." col-class="col-6" required />
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="row">
                            <x-form.select name="transmission" label="Transmission" :options="[
                                'auto' => 'Auto',
                                'manual' => 'Manual',
                            ]"
                                placeholder="Choose transmission type..." col-class="col-6" required />

                            <x-form.input name="seating_capacity" label="Seating Capacity" type="number" min="1"
                                max="50" col-class="col-6" required />
                        </div>
                    </div>
                </div>
            </x-form.card>

            {{-- Insurance & Documents Card --}}
            <x-form.card title="Insurance & Documents">
                <div class="row gy-3">
                    <x-form.input name="license_exp_date" label="License Exp. Date" type="date" required />

                    <x-form.input name="insurance_exp_date" label="Insurance Exp. Date" type="date" required />

                    <x-form.input name="emission_test_exp_date" label="Emission Test Exp. Date" type="date"
                        required />
                </div>
            </x-form.card>

            {{-- Financial & Acquisition Card --}}
            <x-form.card title="Financial & Acquisition">
                <div class="row gy-3">
                    <div class="row">
                        <x-form.input name="purchase_date" label="Purchase Date" type="date" col-class="col-6" />

                        <x-form.currency-input name="purchase_cost" label="Purchase Cost" placeholder="100,000"
                            col-class="col-6" />
                    </div>

                    <x-form.checkbox name="finance" label="Finance" value="1" id="finance" />

                    <x-form.currency-input name="paid_amount" label="Paid Amount" placeholder="100,000"
                        col-class="col-6" />

                    <x-form.currency-input name="balance_to_be_paid" label="Balance To Be Paid" placeholder="100,000"
                        col-class="col-6" />

                    <x-form.input name="remaining_months" label="Remaining Months" type="number" col-class="col-6" />
                </div>
            </x-form.card>

            {{-- Vehicle Rates Card --}}
            <x-form.card title="Vehicle Rates">
                <div class="row gy-3">
                    <x-form.input name="valid_from" label="Valid From" type="date" col-class="col-6" />

                    <x-form.input name="valid_to" label="Valid To" type="date" col-class="col-6" />

                    <x-form.currency-input name="daily_charge" label="Daily Charge" placeholder="1,000" />

                    <x-form.currency-input name="delay_charge_per_day" label="Delay Charge Per Day"
                        placeholder="500" />

                    <x-form.currency-input name="driver_charge_per_day" label="Driver Charge Per Day"
                        placeholder="2,000" />
                </div>
            </x-form.card>

            <!-- Vehicle Images Card -->
            <div class="card mt-24">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0">Vehicle Images</h6>
                    <button type="button" class="btn btn-outline-primary btn-sm" id="addMoreBtn">
                        <i class="bi bi-plus-circle"></i> Add More
                    </button>
                </div>
                <div class="card-body">
                    <div class="row gy-3" id="imageFields">
                        <div class="col-12 image-field">
                            <div class="row align-items-end">
                                <div class="col-4">
                                    <label class="form-label">Image Type</label>
                                    <select class="select2" name="">
                                        <option value="">Select type...</option>
                                        <option value="front_view">Front View</option>
                                        <option value="rear_view">Rear View</option>
                                        <option value="left_side">Left Side</option>
                                        <option value="right_side">Right Side</option>
                                        <option value="interior">Interior</option>
                                        <option value="engine">Engine</option>
                                        <option value="odometer">Odometer</option>
                                        <option value="documents">Documents</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Choose Image</label>
                                    <input class="form-control" type="file" name="vehicle_images[]"
                                        accept="image/*">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-outline-danger btn-sm remove-field"
                                        style="display: none;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Submit Button --}}
            <x-form.card spacing="mt-24" body-class="text-center">
                <button type="submit" class="btn btn-primary px-5">
                    <i class="bi bi-check-circle"></i> Add Vehicle
                </button>
            </x-form.card>
        </form>

        {{-- <form id="vehicleCreationForm" action="/submit-vehicle" method="POST">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Basic Information</h6>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="form-label">Vehicle Number</label>
                            <input type="text" name="vehicle_number" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Vehicle Type</label>
                                    <select class="form-select" name="vehicle_type" required>
                                        <option value="">Choose vehicle type...</option>
                                        <option value="car">Car</option>
                                        <option value="van">Van</option>
                                        <option value="truck">Truck</option>
                                        <option value="motorcycle">Motorcycle</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Model</label>
                                    <select class="form-select" name="model" required>
                                        <option value="">Choose model...</option>
                                        <option value="bmw">BMW</option>
                                        <option value="toyota">Toyota</option>
                                        <option value="audi">Audi</option>
                                        <option value="honda">Honda</option>
                                        <option value="ford">Ford</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Brand</label>
                            <input type="text" name="brand" class="form-control" required>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Manufactured Date</label>
                                    <input type="date" name="manufactured_date" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Registered Date</label>
                                    <input type="date" name="registered_date" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Color</label>
                                    <input type="text" name="color" class="form-control" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Fuel Type</label>
                                    <select class="form-select" name="fuel_type" required>
                                        <option value="">Choose Fuel type...</option>
                                        <option value="petrol">Petrol</option>
                                        <option value="diesel">Diesel</option>
                                        <option value="hybrid">Hybrid</option>
                                        <option value="electric">Electric</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Transmission</label>
                                    <select class="form-select" name="transmission" required>
                                        <option value="">Choose Transmission type...</option>
                                        <option value="auto">Auto</option>
                                        <option value="manual">Manual</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Seating Capacity</label>
                                    <input type="number" name="seating_capacity" class="form-control" min="1"
                                        max="50" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Insurance Card -->
            <div class="card mt-24">
                <div class="card-header">
                    <h6 class="card-title mb-0">Insurance & Documents</h6>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <label class="form-label">License Exp. Date</label>
                            <input type="date" name="license_exp_date" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Insurance Exp. Date</label>
                            <input type="date" name="insurance_exp_date" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Emission Test Exp. Date</label>
                            <input type="date" name="emission_test_exp_date" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service and Maintenance Card -->
            <div class="card mt-24">
                <div class="card-header">
                    <h6 class="card-title mb-0">Service and Maintenance</h6>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Current KM</label>
                                    <input type="number" name="current_km" class="form-control" placeholder="0"
                                        min="0" required>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Last Service KM</label>
                                    <input type="number" name="last_service_km" class="form-control"
                                        placeholder="0" min="0">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6">
                                    <label class="form-label">Service Interval KM</label>
                                    <input type="number" name="service_interval_km" class="form-control"
                                        placeholder="5000" min="0">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Next Service Due KM</label>
                                    <input type="number" name="next_service_due_km" class="form-control"
                                        placeholder="0" min="0" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Last Service Date</label>
                            <input type="date" name="last_service_date" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Financial & Acquisition Card -->
            <div class="card mt-24">
                <div class="card-header">
                    <h6 class="card-title mb-0">Financial & Acqusition</h6>
                </div>

                <div class="card-body">
                    <div class="row gy-3">
                        <div class="row">
                            <div class="col-6">
                                <label class="form-label">Purchase Date</label>
                                <input type="date" name="registered_date" class="form-control">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Purchase Cost</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-base">
                                        Rs.
                                    </span>
                                    <input type="text" class="form-control flex-grow-1" placeholder="100,000">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="finance" id="finance"
                                    value="1">
                                <label class="form-check-label" for="finance">
                                    Finance
                                </label>
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Paid Amount</label>
                            <div class="input-group">
                                <span class="input-group-text bg-base">
                                    Rs.
                                </span>
                                <input type="text" class="form-control flex-grow-1" placeholder="100,000">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Balance To Be Paid</label>
                            <div class="input-group">
                                <span class="input-group-text bg-base">
                                    Rs.
                                </span>
                                <input type="text" class="form-control flex-grow-1" placeholder="100,000">
                            </div>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Remaining Months</label>
                            <input type="number" name="#0" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vehicle Images Card -->
            <div class="card mt-24">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0">Vehicle Images</h6>
                    <button type="button" class="btn btn-outline-primary btn-sm" id="addMoreBtn">
                        <i class="bi bi-plus-circle"></i> Add More
                    </button>
                </div>
                <div class="card-body">
                    <div class="row gy-3" id="imageFields">
                        <div class="col-12 image-field">
                            <div class="row align-items-end">
                                <div class="col-4">
                                    <label class="form-label">Image Type</label>
                                    <select class="select2" name="">
                                        <option value="">Select type...</option>
                                        <option value="front_view">Front View</option>
                                        <option value="rear_view">Rear View</option>
                                        <option value="left_side">Left Side</option>
                                        <option value="right_side">Right Side</option>
                                        <option value="interior">Interior</option>
                                        <option value="engine">Engine</option>
                                        <option value="odometer">Odometer</option>
                                        <option value="documents">Documents</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Choose Image</label>
                                    <input class="form-control" type="file" name="vehicle_images[]"
                                        accept="image/*">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-outline-danger btn-sm remove-field"
                                        style="display: none;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-24">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="card-title mb-0">Vehicle Rates</h6>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-6">
                            <label class="form-label">Valid From</label>
                            <input type="date" name="registered_date" class="form-control">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Valid To</label>
                            <input type="date" name="registered_date" class="form-control">
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Daily Charge</label>
                        <div class="input-group">
                            <span class="input-group-text bg-base">
                                Rs.
                            </span>
                            <input type="text" class="form-control flex-grow-1" placeholder="100,000">
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Delay Charge Per Day</label>
                        <div class="input-group">
                            <span class="input-group-text bg-base">
                                Rs.
                            </span>
                            <input type="text" class="form-control flex-grow-1" placeholder="100,000">
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Driver Charge Per Day</label>
                        <div class="input-group">
                            <span class="input-group-text bg-base">
                                Rs.
                            </span>
                            <input type="text" class="form-control flex-grow-1" placeholder="100,000">
                        </div>
                    </div>
                </div>

            </div>

            <!-- Submit Button -->
            <div class="card mt-4">
                <div class="card-body text-center">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="bi bi-check-circle"></i> Add Vehicle
                    </button>
                </div>
            </div>
        </form> --}}



        <script>
            let fieldCounter = 1;

            document.getElementById('addMoreBtn').addEventListener('click', function() {
                const imageFields = document.getElementById('imageFields');

                // Create new field HTML
                const newField = document.createElement('div');
                newField.className = 'col-12 image-field';
                newField.innerHTML = `
                <div class="row align-items-end">
                    <div class="col-4">
                        <label class="form-label">Image Type</label>
                        <select class="form-select" name="image_type[]">
                            <option value="">Select type...</option>
                            <option value="front_view">Front View</option>
                            <option value="rear_view">Rear View</option>
                            <option value="left_side">Left Side</option>
                            <option value="right_side">Right Side</option>
                            <option value="interior">Interior</option>
                            <option value="engine">Engine</option>
                            <option value="odometer">Odometer</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Choose Image</label>
                        <input class="form-control" type="file" name="vehicle_images[]" accept="image/*">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-field">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            `;

                imageFields.appendChild(newField);
                fieldCounter++;

                // Show remove buttons if more than one field
                updateRemoveButtons();
            });

            // Event delegation for remove buttons
            document.getElementById('imageFields').addEventListener('click', function(e) {
                if (e.target.closest('.remove-field')) {
                    e.target.closest('.image-field').remove();
                    updateRemoveButtons();
                }
            });

            function updateRemoveButtons() {
                const fields = document.querySelectorAll('.image-field');
                const removeButtons = document.querySelectorAll('.remove-field');

                if (fields.length > 1) {
                    removeButtons.forEach(btn => btn.style.display = 'block');
                } else {
                    removeButtons.forEach(btn => btn.style.display = 'none');
                }
            }

            // File input change handler to show selected file name
            document.getElementById('imageFields').addEventListener('change', function(e) {
                if (e.target.type === 'file') {
                    const fileName = e.target.files[0]?.name;
                    if (fileName) {
                        // You can add visual feedback here if needed
                        console.log('Selected file:', fileName);
                    }
                }
            });
        </script>

    </div>


</x-layout>
