@extends('layouts.appdash')

@section('title', 'Add New Product')

@section('content')
<style>
    body {
        background-color: #fff8f0;
        font-family: Arial, sans-serif;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    h1 {
        color: #ff6600;
        text-align: center;
        margin-bottom: 30px;
    }

    .card {
        background-color: #ffffff;
        border: 1px solid #ffcc99;
        border-radius: 10px;
        padding: 30px;
        box-shadow: 0 0 10px rgba(255, 102, 0, 0.1);
    }

    .card-header {
        background-color: transparent;
        border-bottom: 1px solid #ffcc99;
        padding: 0 0 15px 0;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #333;
        font-weight: 500;
    }

    .form-label.required:after {
        content: " *";
        color: #dc3545;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ffcc99;
        border-radius: 5px;
        box-sizing: border-box;
        margin-bottom: 15px;
        transition: border-color 0.3s;
    }

    .form-control:focus {
        border-color: #ff6600;
        outline: none;
        box-shadow: 0 0 5px rgba(255, 102, 0, 0.3);
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    .btn {
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-primary {
        background-color: #ff6600;
        color: white;
        border: none;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
    }

    .btn-light {
        background-color: #f8f9fa;
        color: #333;
        border: 1px solid #ddd;
    }

    .btn-outline-primary {
        border: 1px solid #ff6600;
        color: #ff6600;
        background: transparent;
    }

    .form-text {
        font-size: 12px;
        color: #666;
        margin-top: -10px;
        margin-bottom: 10px;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 12px;
        margin-top: -10px;
        margin-bottom: 10px;
    }

    .button-group {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
    }

    .section-title {
        color: #ff6600;
        border-bottom: 1px solid #ffcc99;
        padding-bottom: 5px;
        margin-bottom: 15px;
    }

    .image-preview {
        margin-top: 10px;
    }

    .image-preview img {
        max-width: 200px;
        max-height: 150px;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 3px;
    }

    .form-row {
        display: flex;
        gap: 15px;
        margin-bottom: 15px;
    }

    .form-col {
        flex: 1;
    }

    .alert-danger {
        background-color: #f8d7da;
        border-color: #f5c6cb;
        color: #721c24;
    }

    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 0;
        }
    }
</style>

<div class="container">
    <h1>Add New Product</h1>

    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2 style="color: #ff6600;">Product Information</h2>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                </a>
            </div>
        </div>
        
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" id="productForm">
                @csrf
                
                <!-- Basic Information Section -->
                <h5 class="section-title">Product Details</h5>

                <div class="mb-3">
                    <label for="name" class="form-label required">Product Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label required">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Pricing and Inventory Section -->
                <h5 class="section-title">Pricing & Inventory</h5>

                <div class="form-row">
                    <div class="form-col">
                        <label for="quantity" class="form-label required">Quantity</label>
                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" 
                               id="quantity" name="quantity" value="{{ old('quantity', 0) }}" min="0" required>
                        @error('quantity')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="form-col">
                        <label for="price" class="form-label required">Price ($)</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" 
                               id="price" name="price" value="{{ old('price', 0.00) }}" min="0" step="0.01" required>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="category_id" class="form-label required">Category</label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Media Section -->
                <h5 class="section-title">Product Media</h5>

                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" 
                           id="image" name="image" accept="image/*">
                    <div class="form-text">
                        Upload a product image (JPG, PNG). Max size: 2MB
                    </div>
                    <div id="image-preview" class="image-preview"></div>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <!-- Status Section -->
                <h5 class="section-title">Product Status</h5>

                <div class="mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                               value="1" {{ old('is_active') ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">
                            Active product (available for purchase)
                        </label>
                    </div>
                </div>
                
                <div class="button-group">
                    <button type="reset" class="btn btn-light">
                        <i class="fas fa-undo"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="preview-content">
                <!-- Preview content will be inserted here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        const preview = document.getElementById('image-preview');
        
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert('The image size should not exceed 2MB');
                this.value = '';
                preview.innerHTML = '';
                return;
            }
            
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail">`;
            };
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    });

    // Preview functionality
    function previewProduct() {
        const name = document.getElementById('name').value;
        const description = document.getElementById('description').value;
        const quantity = document.getElementById('quantity').value;
        const price = document.getElementById('price').value;
        const category = document.getElementById('category_id').options[document.getElementById('category_id').selectedIndex].text;
        const isActive = document.getElementById('is_active').checked;
        
        if (!name || !description || !quantity || !price) {
            alert('Please fill in all required fields to see the preview.');
            return;
        }

        const previewContent = `
            <div>
                <h4 style="color: #ff6600;">${name}</h4>
                <p><span class="badge bg-warning text-dark">${category}</span></p>
                
                <div class="mb-3">
                    <h5 style="color: #ff6600;">Description</h5>
                    <p>${description.replace(/\n/g, '<br>')}</p>
                </div>
                
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5 style="color: #ff6600;">Inventory</h5>
                        <p><i class="fas fa-boxes text-muted me-2"></i>${quantity} in stock</p>
                    </div>
                    <div class="col-md-6">
                        <h5 style="color: #ff6600;">Price</h5>
                        <p><i class="fas fa-tag text-muted me-2"></i>$${parseFloat(price).toFixed(2)}</p>
                    </div>
                </div>
                
                <div class="mb-3">
                    <h5 style="color: #ff6600;">Status</h5>
                    <p><i class="fas fa-circle text-${isActive ? 'success' : 'danger'} me-2"></i>
                    ${isActive ? 'Active (available for purchase)' : 'Inactive (not available)'}</p>
                </div>
            </div>
        `;

        document.getElementById('preview-content').innerHTML = previewContent;
        new bootstrap.Modal(document.getElementById('previewModal')).show();
    }

    // Form submission
    document.getElementById('productForm').addEventListener('submit', function(e) {
        // Add form validation
        this.classList.add('was-validated');
        
        if (!this.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
        }
    });
</script>
@endsection