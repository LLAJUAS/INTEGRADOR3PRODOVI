@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-black">
                    <h4 class="mb-0">Publicar en Facebook</h4>
                </div>

                <div class="card-body">
                    @if(isset($pageInfo['name']))
                        <div class="alert alert-info">
                            <strong>Página:</strong> {{ $pageInfo['name'] }}<br>
                            <strong>ID:</strong> {{ $pageInfo['id'] }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('facebook.post') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="message" class="form-label">Mensaje:</label>
                            <textarea class="form-control" id="message" name="message" 
                                      rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i> Publicar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection