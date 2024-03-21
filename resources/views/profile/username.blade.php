@extends('adminlte::page')

@section('title', 'Perfil')

@section('content_header')
<div class="card-header">
    <h3 class="card-title">Perfil del Usuario</h3>
</div>
@stop

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-6">
            <form id="nameForm" action="{{ route('profile.username') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="card card-primary">
                    <div class="card-body">
                    <p style="text-align: center; "><strong>NOMBRE DE USUARIO</strong></p>
                        <p><strong>Nombre actual:</strong> {{ $user->name }}</p>
                        <div class="form-group">
                            <label for="new_name">Nuevo Nombre:</label>
                            <input type="text" id="new_name" name="new_name" class="form-control" required maxlength="50">
                            <div id="nameError" class="error-message" style="display: none; color: red;">Por favor ingresa un nuevo nombre.</div>
                        </div>
                        <button type="submit" class="btn2" onclick="return validateName()">Actualizar Nombre</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <form id="emailForm" action="{{ route('profile.username') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="card card-primary">
                    <div class="card-body">

                    <p style="text-align: center; "><strong>CORREO ELECTRÓNICO</strong></p>

                        <p><strong>Email actual:</strong> {{ $user->email }}</p>
                        <div class="form-group">
                            <label for="new_email">Nuevo Email:</label>
                            <input type="email" id="new_email" name="new_email" class="form-control" required maxlength="50">
                            <div id="emailError" class="error-message" style="display: none; color: red;">Por favor ingresa un nuevo correo electrónico.</div>
                        </div>
                        <button type="submit" class="btn2" onclick="return validateEmail()">Actualizar Email</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">

        <div class="col-md-6">
            <form id="passwordForm" action="{{ route('profile.username') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="form-group">

                           <p style="text-align: center; "><strong>CONTRASEÑA</strong></p>

                            <p style="text-align: center;">La contraseña debe tener 8 caracteres y debe<br>
                                incluir al menos una letra mayúscula y un símbolo.
                            </p>

                            <label for="password">Nueva contraseña:</label>
                            <input type="password" id="password" name="password" class="form-control" required maxlength="15">

                            <label for="new_password_confirmation">Confirmar contraseña:</label>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required maxlength="15">

                            <div id="passwordError" class="error-message" style="display: none; color: red;">Por favor ingresa una nueva contraseña.</div>

                            @error('new_password_confirmation')
                            <div class="error-message" style="color: red;">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn2" onclick="return validatePassword()">Actualizar Contraseña</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <form id="photoForm" action="{{ route('profile.username') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="card card-primary">
                    <div class="card-body">
                        <p style="text-align: center;"><strong>IMAGEN DE PERFIL</strong></p>
                        <div class="form-group">
                            <p style="text-align: center;">El formato de la imgen debe ser: jpeg, png, jpg o gif<br>
                            y debe tener un tamaño máximo de 2048 KB.</p>

                            <label for="photo">Cargar Nueva Imagen:</label>

                            <input type="file" id="photo" name="photo" class="form-control-file" accept="image/*">
                            <div id="imageSizeError" class="error-message text-danger" style="display: none; color: red;">La imagen es demasiado grande.</div>
                            <div id="imageFormatError" class="error-message text-danger" style="display: none; color: red;">El formato de imagen no es válido.</div>
                            <div id="noImageError" class="error-message" style="display: none; color: red;">Por favor ingresa una imagen.</div>
                        </div>
                        <button type="submit" class="btn2" id="submitButton" onclick="return validateImage()">Cargar Imagen</button>
                    </div>
                    <div class="card-body">
                        @if($user->photo)
                        <p style="text-align: center;"><strong>Imagen actual:</strong></p>
                        <img src="{{ asset($user->photo) }}" alt="Imagen de perfil" class="img-fluid rounded-circle">
                        @else
                        <img src="{{ $user->adminlte_image() }}" alt="Imagen de perfil predeterminada" class="img-fluid rounded-circle">
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@section('css')
<style>
    .btn2 {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
        transition: background-color 0.3s, color 0.3s;
    }

    .btn2:hover {
        background-color: #adb5bd;
    }

    .btn {
        color: white;
        border-color: #6c757d;
    }

    .btn:hover {
        background-color: #adb5bd;
    }

    .btn2.success {
        background-color: #28a745 !important;
        border-color: #28a745 !important;
    }

    .btn2:active {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>
@stop

<script>
    function validateName() {
        var newName = document.getElementById('new_name').value;
        if (newName === '') {
            document.getElementById('nameError').style.display = 'block';
            document.getElementById('nameForm').querySelector('button[type="submit"]').classList.remove('success');
            return false;
        } else {
            document.getElementById('nameForm').querySelector('button[type="submit"]').classList.add('success');
        }
        return true;
    }

    function validateEmail() {
        var newEmail = document.getElementById('new_email').value;
        if (newEmail === '') {
            document.getElementById('emailError').style.display = 'block';
            document.getElementById('emailForm').querySelector('button[type="submit"]').classList.remove('success');
            return false;
        } else {
            document.getElementById('emailForm').querySelector('button[type="submit"]').classList.add('success');
        }
        return true;
    }

    function validatePassword() {
        var newPassword = document.getElementById('password').value;
        var newPasswordConfirmation = document.getElementById('new_password_confirmation').value;

        if (newPassword.length < 8) {
            document.getElementById('passwordError').innerHTML = 'La contraseña debe tener al menos 8 caracteres.';
            document.getElementById('passwordError').style.display = 'block';
            document.getElementById('passwordForm').querySelector('button[type="submit"]').classList.remove('success');
            return false;
        }

        var upperCaseRegex = /[A-Z]/;
        var symbolRegex = /[!@#$%^&*]/;

        if (!upperCaseRegex.test(newPassword) || !symbolRegex.test(newPassword)) {
            document.getElementById('passwordError').innerHTML = 'La contraseña debe incluir al menos una letra mayúscula y un símbolo.';
            document.getElementById('passwordError').style.display = 'block';
            document.getElementById('passwordForm').querySelector('button[type="submit"]').classList.remove('success');
            return false;
        }

        if (newPassword !== newPasswordConfirmation) {
            document.getElementById('passwordError').innerHTML = 'Las contraseñas no coinciden.';
            document.getElementById('passwordError').style.display = 'block';
            document.getElementById('passwordForm').querySelector('button[type="submit"]').classList.remove('success');
            return false;
        }
        
        document.getElementById('passwordForm').querySelector('button[type="submit"]').classList.add('success');
        return true;
    }


    function validateImage() {
        var newImage = document.getElementById('photo').value;
        if (newImage === '') {
            document.getElementById('noImageError').style.display = 'block';
            document.getElementById('photoForm').querySelector('button[type="submit"]').classList.remove('success');
            return false;
        } else {
            document.getElementById('photoForm').querySelector('button[type="submit"]').classList.add('success');
        }
        return true;
    }
</script>

@endsection