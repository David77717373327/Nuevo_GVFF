@extends('gvff::layouts.master')

@section('content')
    <style>
        :root {
            --primary-color: #2f4f2f;
            
            --text-color: #1e293b;
            --ornamental-color: #10b981;
            --medicinal-color: #ef4444;
            --forestal-color: #4b5563;   
        }

        .form-section {
            min-height: 100vh;
            background: var(--background-gradient);
            padding: 3rem 0;
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }

        .form-section .leaf {
            position: absolute;
            width: 24px;
            height: 24px;
            background: url('https://img.icons8.com/ios-filled/50/000000/leaf.png') no-repeat center;
            background-size: contain;
            animation: float 12s infinite ease-in-out;
            opacity: 0.3;
        }

        .form-section .leaf1 { top: 15%; left: 5%; animation-delay: 0s; }
        .form-section .leaf2 { top: 40%; left: 85%; animation-delay: 3s; }
        .form-section .leaf3 { top: 70%; left: 15%; animation-delay: 6s; }

        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(120px) rotate(180deg); }
            100% { transform: translateY(0) rotate(360deg); }
        }

        .animate__fadeIn {
            animation: fadeIn 1.2s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-container {
            max-width: 1200px;
            margin: 0 auto;
            background: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: var(--accent-color);
            font-weight: 700;
            text-align: center;
            margin-bottom: 1.5rem;
            animation: fadeIn 1.2s ease-in-out;
        }

        .alert-success {
            background-color: #d1fae5;
            color: var(--primary-color);
            border: 1px solid #a7f3d0;
            border-radius: 6px;
            padding: 0.75rem 1rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

    


        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-color);
            box-shadow: 0 0 5px rgba(132, 204, 22, 0.3);
        }

        .is-invalid {
            border-color: #ef4444;
        }

        .invalid-feedback {
            color: #ef4444;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-color);
        }

        @media (max-width: 768px) {
            .form-container {
                padding: 1rem;
            }
            .form-control {
                font-size: 0.875rem;
            }
        }
    </style>

    <div class="form-section" data-aos="fade-up">
        <div class="container mx-auto px-6 py-16">
            <div class="form-container" data-aos="zoom-in">
                <h1 class="text-3xl md:text-4px font-bold text-[var(--accent-color)] text-center mb-6 animate__animated animate__fadeIn">
                    Asignar Precio de Venta: {{ $plants->common_name }}
                </h1>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('gvff.admin.plants.processSell', $plants) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="price">Precio (COP):</label>
                        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $plants->price) }}" required step="0.01" min="0">
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-success">Guardar Precio</button>
                </form>
            </div>
            <!-- Floating decorative leaves -->
            <div class="leaf leaf1"></div>
            <div class="leaf leaf2"></div>
            <div class="leaf leaf3"></div>
        </div>
    </div>
@endsection