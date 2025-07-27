<x-layout>
    <div class="dashboard-main-body">
        <x-content-header title="Create Invoice" breadcrumb="AI" breadcrumb-url="index.html" />

        {{-- Example: Using the components in your vehicle form --}}
        <form id="invoiceCreationForm" action="/submit-invoice" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Basic Information Card --}}
            <x-form.card title="Customer" spacing="">
                <div class="row gy-3">
                    <div class="col-12">
                        <div class="row align-items-end">
                            <div class="col-10">
                                {{-- :options="$customers->pluck('name', 'id')->toArray() --}}
                                <x-form.select name="customer_id" label="Select Customer"
                                    placeholder="Choose customer..." required id="customerSelect" />
                            </div>
                            <div class="col-2">
                                <button type="button" class="btn btn-outline-success w-100" data-bs-toggle="modal"
                                    data-bs-target="#customerModal">
                                    <i class="bi bi-plus-circle"></i> Add New
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </x-form.card>

            {{-- Vehicle Information Card --}}
            <x-form.card title="Vehicle">
                <div class="row gy-3">
                    <div class="col-12">
                        <x-form.select name="vehicle" label="Select Vehicle" :options="[
                            'car' => 'Car',
                            'van' => 'Van',
                            'truck' => 'Truck',
                            'motorcycle' => 'Motorcycle',
                        ]"
                            placeholder="Choose vehicle..." col-class="col-12" required />
                    </div>
                </div>
            </x-form.card>

            {{-- rent charge --}}
            <x-form.card title="Rent Charge">
                <div class="row gy-3">
                    <x-form.select name="unit" label="Select Unit" :options="[
                        'days' => 'Days',
                        'km' => 'Km',
                    ]" placeholder="Choose unit..."
                        col-class="col-4" required />

                    <x-form.currency-input name="unitPrice" label="Per day" placeholder="100,000" col-class="col-4" />

                    <x-form.currency-input name="rent" label="Rent amount" placeholder="100,000" col-class="col-4" />
                </div>
            </x-form.card>

            {{-- Extra Charge --}}
            <x-form.card title="Extra Km Charge">
                <div class="row gy-3">
                    <x-form.select name="unit" label="Select Unit" :options="[
                        'days' => 'Days',
                        'km' => 'Km',
                    ]" placeholder="Choose unit..."
                        col-class="col-4" required />

                    <x-form.currency-input name="unitPrice" label="Per Km" placeholder="100,000" col-class="col-4" />

                    <x-form.currency-input name="days" label="Extra Charge" placeholder="100,000"
                        col-class="col-4" />
                </div>
            </x-form.card>

            {{-- Damage Cost --}}
            <x-form.card title="Damage Cost">
                <x-slot name="headerActions">
                    <button type="button" class="btn btn-outline-primary btn-sm" id="addDamageBtn">
                        <i class="bi bi-plus-circle"></i> Add Damages
                    </button>
                </x-slot>

                <div class="row gy-3" id="damageFields">
                    <div class="col-12 damage-field">
                        <div class="row align-items-end">
                            <x-form.input name="damage[]" label="Damage" type="text" col-class="col-6"
                                placeholder="Enter damage description" />

                            <x-form.currency-input name="damage_cost[]" label="Damage Cost" placeholder="5,000"
                                col-class="col-4" />

                            <div class="col-2">
                                <button type="button" class="btn btn-outline-danger btn-sm remove-field w-100"
                                    style="display: none;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Optional: Total Display --}}
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="border-top pt-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <strong>Total Damage Cost:</strong>
                                <span id="totalDamageCost" class="text-primary fs-5 fw-bold">Rs. 0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </x-form.card>

            <!-- Adnavce and retention amount -->
            <x-form.card title="Advance and Retention Amount">
                <div class="row gy-3">
                    <x-form.currency-input name="advance_amount" label="Advance Amount" placeholder="0"
                        col-class="col-6" />

                    <x-form.currency-input name="retention_amount" label="Retention Amount" placeholder="0"
                        col-class="col-6" />
                </div>
            </x-form.card>

            {{-- Discount --}}
            <x-form.card title="Discount">
                <div class="row gy-3">
                    <div class="col-12">
                        <div class="row">
                            <x-form.select name="discount_type" label="Discount Type" :options="[
                                'percentage' => 'Percentage (%)',
                                'fixed' => 'Fixed Amount (Rs.)',
                            ]"
                                placeholder="Choose discount type..." col-class="col-6" id="discountType"
                                onchange="handleDiscountTypeChange()" />

                            <div class="col-6">
                                <div id="percentageField" style="display: none;">
                                    <x-form.input name="discount_percentage" label="Discount Percentage"
                                        type="number" min="0" max="100" step="0.01"
                                        placeholder="10.5" col-class="" id="discountPercentage"
                                        onchange="calculateFinalAmount()" />
                                </div>

                                <div id="fixedField" style="display: none;">
                                    <x-form.currency-input name="discount_fixed" label="Fixed Discount Amount"
                                        placeholder="5,000" col-class="" id="discountFixed"
                                        onchange="calculateFinalAmount()" />
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Summary Section --}}
                    <div class="col-12">
                        <div class="card bg-light border">
                            <div class="card-body">
                                <h6 class="card-title mb-3">Amount Summary</h6>

                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-2">
                                            <small class="text-muted">Subtotal:</small>
                                            <div class="fw-bold" id="subtotalAmount">Rs. 0</div>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="mb-2">
                                            <small class="text-muted">Discount:</small>
                                            <div class="fw-bold text-danger" id="discountAmount">- Rs. 0</div>
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-2">

                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold fs-5">Final Amount:</span>
                                    <span class="fw-bold fs-4 text-primary" id="finalAmount">Rs. 0</span>
                                </div>

                                {{-- Hidden field to store final amount --}}
                                <input type="hidden" name="final_amount" id="finalAmountInput" value="0">
                                <input type="hidden" name="discount_amount" id="discountAmountInput"
                                    value="0">
                            </div>
                        </div>
                    </div>
                </div>
            </x-form.card>

            {{-- Submit Button --}}
            <x-form.card spacing="mt-24" body-class="text-center">
                <button type="submit" class="btn btn-primary px-5">
                    <i class="bi bi-check-circle"></i> Add Invoice
                </button>
            </x-form.card>
        </form>

        {{-- damage management --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let damageFieldCounter = 1;

                const addDamageBtn = document.getElementById('addDamageBtn');
                const damageFields = document.getElementById('damageFields');

                if (addDamageBtn) {
                    addDamageBtn.addEventListener('click', function() {
                        // Create new field HTML
                        const newField = document.createElement('div');
                        newField.className = 'col-12 damage-field';
                        newField.innerHTML = `
                    <div class="row align-items-end">
                        <div class="col-6">
                            <label class="form-label">Damage</label>
                            <input type="text" name="damage[]" class="form-control" placeholder="Enter damage description">
                        </div>
                        <div class="col-4">
                            <label class="form-label">Damage Cost</label>
                            <div class="input-group">
                                <span class="input-group-text bg-base">Rs.</span>
                                <input type="text" name="damage_cost[]" class="form-control flex-grow-1" placeholder="5,000">
                            </div>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-outline-danger btn-sm remove-field w-100">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                `;

                        damageFields.appendChild(newField);
                        damageFieldCounter++;

                        // Show remove buttons if more than one field
                        updateDamageRemoveButtons();
                    });
                }

                // Event delegation for remove buttons
                if (damageFields) {
                    damageFields.addEventListener('click', function(e) {
                        if (e.target.closest('.remove-field')) {
                            e.target.closest('.damage-field').remove();
                            updateDamageRemoveButtons();
                            calculateTotalDamageCost(); // Recalculate total after removal
                        }
                    });

                    // Auto-calculate total damage cost
                    damageFields.addEventListener('input', function(e) {
                        if (e.target.name && e.target.name.includes('damage_cost')) {
                            calculateTotalDamageCost();
                        }
                    });
                }

                function updateDamageRemoveButtons() {
                    const fields = document.querySelectorAll('#damageFields .damage-field');
                    const removeButtons = document.querySelectorAll('#damageFields .remove-field');

                    if (fields.length > 1) {
                        removeButtons.forEach(btn => btn.style.display = 'block');
                    } else {
                        removeButtons.forEach(btn => btn.style.display = 'none');
                    }
                }

                function calculateTotalDamageCost() {
                    const costInputs = document.querySelectorAll('input[name="damage_cost[]"]');
                    let total = 0;

                    costInputs.forEach(input => {
                        const value = input.value.replace(/[^0-9.]/g, ''); // Remove currency symbols and commas
                        if (value && !isNaN(value)) {
                            total += parseFloat(value);
                        }
                    });

                    // Update total display
                    const totalDisplay = document.getElementById('totalDamageCost');
                    if (totalDisplay) {
                        totalDisplay.textContent = 'Total Damage Amount(Rs.) ' + total.toLocaleString();
                    }
                }

                // Initialize
                updateDamageRemoveButtons();
                calculateTotalDamageCost();
            });
        </script>

        {{-- discount management --}}
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize the discount type change handler
                const discountTypeSelect = document.getElementById('discountType');
                if (discountTypeSelect) {
                    handleDiscountTypeChange();
                }

                // Listen for changes in amount fields to recalculate
                document.addEventListener('input', function(e) {
                    // If the changed field affects the calculation, recalculate
                    if (e.target.name && (
                            e.target.name.includes('rent') ||
                            e.target.name.includes('unitPrice') ||
                            e.target.name.includes('days') ||
                            e.target.name.includes('damage_cost') ||
                            e.target.name.includes('discount') ||
                            e.target.name.includes('advance_amount') ||
                            e.target.name.includes('retention_amount')
                        )) {
                        calculateFinalAmount();
                    }
                });

                // Initial calculation
                calculateFinalAmount();
            });

            function handleDiscountTypeChange() {
                const discountType = document.getElementById('discountType').value;
                const percentageField = document.getElementById('percentageField');
                const fixedField = document.getElementById('fixedField');
                const discountPercentage = document.getElementById('discountPercentage');
                const discountFixed = document.getElementById('discountFixed');

                // Reset values
                if (discountPercentage) discountPercentage.value = '';
                if (discountFixed) discountFixed.value = '';

                // Show/hide appropriate field
                if (discountType === 'percentage') {
                    percentageField.style.display = 'block';
                    fixedField.style.display = 'none';
                } else if (discountType === 'fixed') {
                    percentageField.style.display = 'none';
                    fixedField.style.display = 'block';
                } else {
                    percentageField.style.display = 'none';
                    fixedField.style.display = 'none';
                }

                // Recalculate amounts
                calculateFinalAmount();
            }

            function calculateSubtotal() {
                let subtotal = 0;

                // Add rent amount
                const rentInput = document.querySelector('input[name="rent"]');
                if (rentInput) {
                    const value = rentInput.value.replace(/[^0-9.]/g, '');
                    if (value && !isNaN(value)) {
                        subtotal += parseFloat(value);
                    }
                }

                // Add extra charge (from Extra Km Charge card)
                const extraChargeInput = document.querySelector(
                'input[name="days"]'); // This seems to be the extra charge field
                if (extraChargeInput) {
                    const value = extraChargeInput.value.replace(/[^0-9.]/g, '');
                    if (value && !isNaN(value)) {
                        subtotal += parseFloat(value);
                    }
                }

                // Add damage costs
                const damageCostInputs = document.querySelectorAll('input[name="damage_cost[]"]');
                damageCostInputs.forEach(input => {
                    const value = input.value.replace(/[^0-9.]/g, '');
                    if (value && !isNaN(value)) {
                        subtotal += parseFloat(value);
                    }
                });

                return subtotal;
            }

            function calculateFinalAmount() {
                const subtotal = calculateSubtotal();
                const discountType = document.getElementById('discountType').value;
                let discountAmount = 0;

                // Calculate discount
                if (discountType === 'percentage') {
                    const percentage = document.getElementById('discountPercentage').value;
                    if (percentage && !isNaN(percentage)) {
                        discountAmount = (subtotal * parseFloat(percentage)) / 100;
                    }
                } else if (discountType === 'fixed') {
                    const fixedDiscount = document.getElementById('discountFixed').value;
                    if (fixedDiscount) {
                        const cleanValue = fixedDiscount.replace(/[^0-9.]/g, '');
                        if (cleanValue && !isNaN(cleanValue)) {
                            discountAmount = parseFloat(cleanValue);
                        }
                    }
                }

                // Ensure discount doesn't exceed subtotal
                discountAmount = Math.min(discountAmount, subtotal);

                // Calculate amount after discount
                const amountAfterDiscount = subtotal - discountAmount;

                // Get advance and retention amounts
                let advanceAmount = 0;
                let retentionAmount = 0;

                const advanceInput = document.querySelector('input[name="advance_amount"]');
                if (advanceInput) {
                    const value = advanceInput.value.replace(/[^0-9.]/g, '');
                    if (value && !isNaN(value)) {
                        advanceAmount = parseFloat(value);
                    }
                }

                const retentionInput = document.querySelector('input[name="retention_amount"]');
                if (retentionInput) {
                    const value = retentionInput.value.replace(/[^0-9.]/g, '');
                    if (value && !isNaN(value)) {
                        retentionAmount = parseFloat(value);
                    }
                }

                // Calculate final amount (subtract advance and retention from amount after discount)
                const finalAmount = amountAfterDiscount - advanceAmount - retentionAmount;

                // Update displays
                const subtotalDisplay = document.getElementById('subtotalAmount');
                const discountDisplay = document.getElementById('discountAmount');
                const finalDisplay = document.getElementById('finalAmount');
                const finalAmountInput = document.getElementById('finalAmountInput');
                const discountAmountInput = document.getElementById('discountAmountInput');

                if (subtotalDisplay) {
                    subtotalDisplay.textContent = 'Rs. ' + subtotal.toLocaleString();
                }

                if (discountDisplay) {
                    discountDisplay.textContent = '- Rs. ' + discountAmount.toLocaleString();
                }

                if (finalDisplay) {
                    finalDisplay.textContent = 'Rs. ' + finalAmount.toLocaleString();
                }

                // Update hidden inputs for form submission
                if (finalAmountInput) {
                    finalAmountInput.value = finalAmount;
                }

                if (discountAmountInput) {
                    discountAmountInput.value = discountAmount;
                }

                // Also update total damage cost display if it exists
                const totalDamageCost = document.getElementById('totalDamageCost');
                if (totalDamageCost) {
                    let totalDamage = 0;
                    damageCostInputs = document.querySelectorAll('input[name="damage_cost[]"]');
                    damageCostInputs.forEach(input => {
                        const value = input.value.replace(/[^0-9.]/g, '');
                        if (value && !isNaN(value)) {
                            totalDamage += parseFloat(value);
                        }
                    });
                    totalDamageCost.textContent = 'Rs. ' + totalDamage.toLocaleString();
                }
            }

            // Helper function to format currency input as user types
            function formatCurrencyInput(input) {
                let value = input.value.replace(/[^0-9.]/g, '');
                if (value) {
                    // Add thousand separators
                    const parts = value.split('.');
                    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                    input.value = parts.join('.');
                }
            }

            // Add formatting to currency inputs
            document.addEventListener('input', function(e) {
                if (e.target.name && (
                        e.target.name.includes('discount_fixed') ||
                        e.target.name.includes('rent') ||
                        e.target.name.includes('unitPrice') ||
                        e.target.name.includes('days') ||
                        e.target.name.includes('damage_cost') ||
                        e.target.name.includes('advance_amount') ||
                        e.target.name.includes('retention_amount')
                    )) {
                    if (e.target.type !== 'number') {
                        formatCurrencyInput(e.target);
                    }
                    calculateFinalAmount();
                }
            });
        </script>

    </div>

</x-layout>
