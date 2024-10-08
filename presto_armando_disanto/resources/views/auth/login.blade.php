<x-layout>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="display-4 pt-5">
                    Accedi
                </h1>
            </div>
        </div>

        <div class="row justify-content-center align-items-center height-custom">
            <div class="col-12 col-md-6">
                <!-- Mostra i messaggi di errore se presenti -->
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="bg-secondary-subtle shadow rounded p-5">
                    @csrf
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Indirizzo E-mail</label>
                        <input type="email" class="form-control" id="loginEmail" name="email"
                            value="{{ old('email') }}">
                        <!-- Mostra errore per il campo email -->
                        @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                        <!-- Mostra errore per il campo password -->
                        @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Accedi</button>
                </form>

            </div>
        </div>
    </div>

</x-layout>
