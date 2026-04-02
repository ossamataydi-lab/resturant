@extends('layouts.app')

@section('content')
<section id="reservation" style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #fafafa 0%, #f5f0e8 100%); padding: 80px 20px;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-10">

                <!-- Header -->
                <div class="text-center mb-5">
                    <span class="section-subtitle" style="display: inline-block; font-size: 0.75rem;padding-top:20px; letter-spacing: 0.3em; text-transform: uppercase; color: var(--gold); margin-bottom: 15px;">
                        <i class="fas fa-wine-glass-alt me-2"></i>Restaurant Le Délice Gourmand
                    </span>
                    <h2 class="section-title" style="font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 700; color: var(--dark); margin-bottom: 15px;">
                        Réservation en ligne
                    </h2>
                    <p class="section-desc" style="color: #666; font-size: 1.1rem; max-width: 500px; margin: 0 auto;">
                        Réservez votre table en quelques clics et savourez un moment inoubliable
                    </p>
                </div>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="alert-custom mb-4" style="background: linear-gradient(135deg, #28a745, #34ce57); color: white; padding: 18px 25px; border-radius: 15px; display: flex; align-items: center; gap: 12px; box-shadow: 0 10px 30px rgba(40, 167, 69, 0.25);">
                        <i class="fas fa-check-circle" style="font-size: 1.3rem;"></i>
                        <span style="font-weight: 500;">{{ session('success') }}</span>
                    </div>
                @endif

                <!-- Form Card -->
                <div class="reservation-card" style="background: white; border-radius: 25px; padding: 45px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08); position: relative; overflow: hidden;">
                    <!-- Decorative Element -->
                    <div style="position: absolute; top: 0; left: 0; right: 0; height: 5px; background: linear-gradient(90deg, var(--gold), #d4af7a, var(--gold));"></div>

                    <form action="{{ route('reservation.store') }}" method="POST" id="booking-form">
                        @csrf

                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-md-6 mb-4">
                                <label for="name" class="form-label" style="font-weight: 600; color: var(--dark); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-user" style="color: var(--gold);"></i>
                                    Nom complet
                                </label>
                                <div class="input-group-custom" style="position: relative;">
                                    <input type="text" name="customer_name" id="name" class="form-control-custom" required value="{{ old('customer_name') }}" placeholder="Votre nom">
                                    <span class="input-icon"><i class="fas fa-user"></i></span>
                                </div>
                            </div>

                            <!-- Phone Field -->
                            <div class="col-md-6 mb-4">
                                <label for="phone" class="form-label" style="font-weight: 600; color: var(--dark); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-phone" style="color: var(--gold);"></i>
                                    Téléphone
                                </label>
                                <div class="input-group-custom" style="position: relative;">
                                    <input type="tel" name="customer_phone" id="phone" class="form-control-custom" required value="{{ old('customer_phone') }}" placeholder="+212 6XX XXX XXX">
                                    <span class="input-icon"><i class="fas fa-phone"></i></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Date & Time Field -->
                            <div class="col-md-6 mb-4">
                                <label for="date_time" class="form-label" style="font-weight: 600; color: var(--dark); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-calendar-alt" style="color: var(--gold);"></i>
                                    Date et Heure
                                </label>
                                <div class="input-group-custom" style="position: relative;">
                                    <input type="datetime-local" name="reservation_time" id="date_time" class="form-control-custom" required>
                                    <span class="input-icon"><i class="fas fa-calendar-alt"></i></span>
                                </div>
                            </div>

                            <!-- Guest Count Field -->
                            <div class="col-md-6 mb-4">
                                <label for="guests" class="form-label" style="font-weight: 600; color: var(--dark); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                                    <i class="fas fa-users" style="color: var(--gold);"></i>
                                    Nombre de personnes
                                </label>
                                <div class="input-group-custom" style="position: relative;">
                                    <select name="guest_count" id="guests" class="form-control-custom" required style="cursor: pointer;">
                                        <option value="">Sélectionner</option>
                                        @for ($i = 1; $i <= 8; $i++)
                                            <option value="{{ $i }}">{{ $i }} personne{{ $i > 1 ? 's' : '' }}</option>
                                        @endfor
                                    </select>
                                    <span class="input-icon"><i class="fas fa-users"></i></span>
                                </div>
                            </div>
                        </div>

                     

                        <!-- Notes Field -->
                        <div class="mb-4">
                            <label for="notes" class="form-label" style="font-weight: 600; color: var(--dark); margin-bottom: 10px; display: flex; align-items: center; gap: 8px;">
                                <i class="fas fa-comment-alt" style="color: var(--gold);"></i>
                                Notes spéciales <span style="font-weight: 400; color: #888; font-size: 0.9rem;">(optionnel)</span>
                            </label>
                            <textarea name="notes" id="notes" class="form-control-custom" rows="3" placeholder="Occasion spéciale, allergies, préférences..." style="resize: none;"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn-submit" style="width: 100%; background: linear-gradient(135deg, var(--dark) 0%, #2a2d30 100%); color: white; border: none; padding: 18px 30px; border-radius: 15px; font-size: 1.1rem; font-weight: 600; letter-spacing: 0.05em; cursor: pointer; transition: all 0.4s ease; position: relative; overflow: hidden;">
                            <span style="position: relative; z-index: 1;">
                                <i class="fas fa-calendar-check me-2"></i>Réserver maintenant
                            </span>
                            <div class="btn-hover-effect" style="position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(135deg, var(--gold) 0%, #d4af7a 100%); transition: all 0.4s ease;"></div>
                        </button>

                        <!-- Contact Info -->
                        <div class="text-center mt-4" style="color: #888; font-size: 0.9rem;">
                            <p style="margin: 0;">
                                <i class="fas fa-phone-alt me-2" style="color: var(--gold);"></i>
                                Pour toute réservation urgente: <strong>+212 5XX XXX XXX</strong>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    /* Form Control Styles */
    .form-control-custom {
        width: 100%;
        padding: 16px 20px 16px 50px;
        border: 2px solid #eee;
        border-radius: 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #fafafa;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: var(--gold);
        background: white;
        box-shadow: 0 5px 20px rgba(197, 160, 89, 0.15);
    }

    .form-control-custom::placeholder {
        color: #aaa;
    }

    /* Input Group Custom */
    .input-group-custom {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        color: #ccc;
        transition: color 0.3s ease;
        z-index: 10;
    }

    .input-group-custom:focus-within .input-icon {
        color: var(--gold);
    }

    /* Table Option Selection */
    .table-option input:checked + .table-card {
        border-color: var(--gold);
        background: linear-gradient(135deg, rgba(197, 160, 89, 0.1) 0%, rgba(197, 160, 89, 0.05) 100%);
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(197, 160, 89, 0.2);
    }

    .table-option:hover .table-card {
        border-color: #ddd;
        transform: translateY(-2px);
    }

    .table-option input:checked + .table-card {
        border-color: var(--gold);
    }

    /* Submit Button Hover */
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(15, 17, 19, 0.3);
    }

    .btn-submit:hover .btn-hover-effect {
        left: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .section-title {
            font-size: 2rem !important;
        }

        .reservation-card {
            padding: 30px 20px !important;
        }

        .table-options {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .reservation-card {
        animation: fadeInUp 0.6s ease forwards;
    }

    .alert-custom {
        animation: fadeInUp 0.5s ease forwards;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set min date to current datetime
        const dateInput = document.getElementById('date_time');
        const now = new Date();
        now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
        dateInput.min = now.toISOString().slice(0, 16);

        // Form validation feedback
        const form = document.getElementById('booking-form');
        const inputs = form.querySelectorAll('input, select, textarea');

        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.closest('.input-group-custom')?.classList.add('focused');
            });

            input.addEventListener('blur', function() {
                this.closest('.input-group-custom')?.classList.remove('focused');
            });
        });
    });
</script>
@endsection
