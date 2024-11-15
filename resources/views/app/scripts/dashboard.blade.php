<script>
    "use strict";

    var KTPosSystem = function() {
        var form;
        var orderItems = [];
        var discount = 0;
        var grandTotal = 0;

        var moneyFormat = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'USD',
            minimumFractionDigits: 2
        });

        var calculateTotals = function() {
            var total = orderItems.reduce((sum, item) => sum + item.price * item.quantity, 0);
            var tax = total * (taxRate / 100);
            grandTotal = total + tax - discount;

            if (discount > total + tax) {
                discount = total + tax;
            }

            grandTotal = total + tax - discount;

            form.querySelector('[data-kt-pos-element="total"]').innerHTML = moneyFormat.format(total);
            form.querySelector('[data-kt-pos-element="discount"]').innerHTML = moneyFormat.format(discount);
            form.querySelector('[data-kt-pos-element="tax"]').innerHTML = moneyFormat.format(tax);
            form.querySelector('[data-kt-pos-element="grant-total"]').innerHTML = moneyFormat.format(
            grandTotal);

            form.querySelector('input[name="total"]').value = total;
            form.querySelector('input[name="tax"]').value = tax;
            form.querySelector('input[name="discount"]').value = discount;
            form.querySelector('input[name="grand_total"]').value = grandTotal;
        }

        var updateOrderTable = function() {
            var orderTable = document.getElementById('order_items');
            orderTable.innerHTML = '';

            orderItems.forEach((item, index) => {
                var row = orderTable.insertRow();
                row.innerHTML = `
                <td>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-40px me-3">
                            <img src="${item.image}" class="w-100" alt="${item.name}">
                        </div>
                        <div class="d-flex flex-column">
                            <span class="text-gray-800 fw-bold">${item.name}</span>
                            <span class="text-gray-400 fw-semibold">${moneyFormat.format(item.price)}</span>
                        </div>
                    </div>
                </td>
                <td class="text-end">
                    <div class="d-flex align-items-center justify-content-end">
                        <button type="button" class="btn btn-sm btn-icon btn-light-primary me-2 quantity-decrease" data-index="${index}">
                            <i class="bi bi-dash-lg"></i>
                        </button>
                        <span class="text-gray-800 fw-bold mx-2" data-kt-pos-element="item-quantity">${item.quantity}</span>
                        <button type="button" class="btn btn-sm btn-icon btn-light-primary ms-2 quantity-increase" data-index="${index}">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </div>
                </td>
                <td class="text-end">
                    <span class="text-gray-800 fw-bold" data-kt-pos-element="item-total">${moneyFormat.format(item.price * item.quantity)}</span>
                </td>
                <td class="text-end">
                    <button type="button" class="btn btn-sm btn-icon btn-light-danger delete-item" data-index="${index}">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </td>
            `;
            });

            form.querySelector('input[name="order_items"]').value = JSON.stringify(orderItems);

            attachQuantityListeners();
            attachDeleteListeners();
            calculateTotals();
        }

        var attachQuantityListeners = function() {
            document.querySelectorAll('.quantity-decrease').forEach(btn => {
                btn.addEventListener('click', function() {
                    var index = parseInt(this.getAttribute('data-index'));
                    if (orderItems[index].quantity > 1) {
                        orderItems[index].quantity -= 1;
                        updateOrderTable();
                    }
                });
            });

            document.querySelectorAll('.quantity-increase').forEach(btn => {
                btn.addEventListener('click', function() {
                    var index = parseInt(this.getAttribute('data-index'));
                    orderItems[index].quantity += 1;
                    updateOrderTable();
                });
            });
        }

        var attachDeleteListeners = function() {
            document.querySelectorAll('.delete-item').forEach(btn => {
                btn.addEventListener('click', function() {
                    var index = parseInt(this.getAttribute('data-index'));
                    orderItems.splice(index, 1);
                    updateOrderTable();
                });
            });
        }

        var handleProductSelection = function() {
            var productItems = document.querySelectorAll('.product-item');
            productItems.forEach(item => {
                item.addEventListener('click', function() {
                    var productId = this.getAttribute('data-product-id');
                    var productName = this.querySelector('.fw-bold').textContent;
                    var productPrice = parseFloat(this.querySelector('.text-success')
                        .textContent.replace(/[^0-9.-]+/g, ""));
                    var productImage = this.querySelector('img').src;

                    var existingItem = orderItems.find(item => item.id === productId);
                    if (existingItem) {
                        existingItem.quantity += 1;
                    } else {
                        orderItems.push({
                            id: productId,
                            name: productName,
                            price: productPrice,
                            quantity: 1,
                            image: productImage
                        });
                    }

                    updateOrderTable();
                });
            });
        }

        var handleClearAll = function() {
            var clearAllBtn = document.getElementById('clear_all');
            clearAllBtn.addEventListener('click', function(e) {
                e.preventDefault();
                orderItems = [];
                updateOrderTable();

                document.getElementById('note').value = '';
            });
        }

        var handleDiscountInput = function() {
            var discountElement = form.querySelector('[data-kt-pos-element="discount"]');
            var discountInput = document.getElementById('discount_input');

            discountElement.addEventListener('click', function() {
                discountInput.value = discount;
                discountElement.classList.add('d-none');
                discountInput.classList.remove('d-none');
                discountInput.focus();
            });

            discountInput.addEventListener('blur', function() {
                var discountValue = parseFloat(discountInput.value) || 0;

                if (discountValue > form.querySelector('input[name="total"]').value) {
                    discountValue = form.querySelector('input[name="total"]').value;
                }

                discount = discountValue;

                discountElement.classList.remove('d-none');
                discountInput.classList.add('d-none');

                calculateTotals();
            });

            discountInput.addEventListener('input', function() {
                var discountValue = parseFloat(discountInput.value) || 0;

                if (discountValue > form.querySelector('input[name="total"]').value) {
                    discountValue = form.querySelector('input[name="total"]').value;
                }

                discount = discountValue;
                calculateTotals();
            });
        }

        var handleProductSearch = function() {
            var searchInput = document.getElementById('product_search');

            searchInput.addEventListener('input', function() {
                var searchTerm = searchInput.value.toLowerCase();
                var productItems = document.querySelectorAll('.product-item');

                productItems.forEach(item => {
                    var productName = item.querySelector('.fw-bold').textContent.toLowerCase();
                    if (productName.includes(searchTerm)) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        }

        var handleCompleteOrder = function() {
            var completeOrderBtn = document.getElementById('complete_order');
            var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
            var amountPaidInput = document.getElementById('amountPaid');
            var changeDueElement = document.getElementById('changeDue');
            var modalGrandTotal = document.getElementById('modalGrandTotal');
            var confirmPaymentBtn = document.getElementById('confirmPayment');
            var clearPaymentBtn = document.getElementById('payment-clear');

            var isProcessing = false;

            completeOrderBtn.addEventListener('click', function(e) {
                e.preventDefault();

                if (orderItems.length > 0) {
                    calculateTotals();
                    modalGrandTotal.textContent = moneyFormat.format(grandTotal);
                    paymentModal.show();
                } else {
                    Swal.fire({
                        text: "Please add items to your order before completing.",
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });

            amountPaidInput.addEventListener('input', function() {
                var amountPaid = parseFloat(amountPaidInput.value) || 0;
                var changeDue = amountPaid - grandTotal;
                changeDueElement.textContent = moneyFormat.format(changeDue > 0 ? changeDue : 0);
            });

            document.querySelectorAll('.card.bg-primary').forEach(function(card) {
                card.addEventListener('click', function() {
                    var bankNoteValue = parseFloat(this.querySelector('b').textContent.replace(
                        /[^0-9.-]+/g, ""));
                    var currentAmountPaid = parseFloat(amountPaidInput.value) || 0;
                    amountPaidInput.value = (currentAmountPaid + bankNoteValue).toFixed(2);

                    var amountPaid = parseFloat(amountPaidInput.value) || 0;
                    var changeDue = amountPaid - grandTotal;
                    changeDueElement.textContent = moneyFormat.format(changeDue > 0 ?
                        changeDue : 0);
                });
            });

            confirmPaymentBtn.addEventListener('click', function() {
                if (isProcessing) return;

                var amountPaid = parseFloat(amountPaidInput.value) || 0;

                if (amountPaid >= grandTotal) {
                    isProcessing = true;
                    orderNumber++;
                    var formData = new FormData(form);
                    var orderData = {
                        orderItems: orderItems,
                        total: grandTotal,
                        amountPaid: amountPaid,
                        changeDue: amountPaid - grandTotal,
                        note: document.getElementById('note').value,
                        cashier: '{{ ucwords(auth()->user()->name) }}',
                        orderNumber: orderNumber
                    };

                    addNewOrderToUI(orderData);

                    if (!navigator.onLine) {
                        saveOrderOffline(orderData);
                        Swal.fire({
                            text: "You are offline. Your order has been saved and will be submitted once you're back online.",
                            icon: "info",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {
                            resetOrderForm();
                        });
                        paymentModal.hide();
                        isProcessing = false;
                        return;
                    }

                    fetch(form.action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content')
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    text: "Order completed successfully!",
                                    icon: "success",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                }).then(function(result) {
                                    if (result.isConfirmed) {
                                        printReceipt();

                                        orderItems = [];
                                        updateOrderTable();
                                        document.getElementById('note').value = '';
                                        amountPaidInput.value = 0;
                                    }
                                });
                            } else {
                                Swal.fire({
                                    text: data.message ||
                                        "An error occurred while processing your order.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary"
                                    }
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire({
                                text: "An unexpected error occurred. Please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        })
                        .finally(() => {
                            isProcessing = false;
                            paymentModal.hide();
                        });
                } else {
                    Swal.fire({
                        text: "The amount paid is less than the grand total.",
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });

            clearPaymentBtn.addEventListener('click', function() {
                amountPaidInput.value = '';
                changeDueElement.textContent = moneyFormat.format(0);
            });
        };

        var addProductToOrder = function(product) {
            var existingItem = orderItems.find(item => item.id === product.id);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                orderItems.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    quantity: 1,
                    image: product.image
                });
            }
            updateOrderTable();
        }

        function resetOrderForm() {
            orderItems = [];
            updateOrderTable();
            document.getElementById('note').value = '';
            amountPaidInput.value = 0;
            changeDueElement.textContent = moneyFormat.format(0);
        }

        return {
            init: function() {
                form = document.querySelector('#kt_pos_form');
                handleProductSelection();
                handleClearAll();
                handleCompleteOrder();
                handleDiscountInput();
                handleProductSearch();
                handleBarcodeInput();
            }
        };
    }();

    KTUtil.onDOMContentLoaded(function() {
        KTPosSystem.init();
    });
</script>