@extends('layouts.appdash')
@section('title', 'Gestion Newsletter')
@section('content')

<!-- Newsletter Subscribers Table -->
            <div class="card mt-5">
                <div class="card-header bg-warning text-dark fw-bold">
                    <i class="fas fa-envelope me-2"></i>Emails inscrits à la newsletter
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Date d'inscription</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\App\Models\Newsletter::orderBy('created_at', 'desc')->get() as $subscriber)
                                    <tr>
                                        <td>{{ $subscriber->id }}</td>
                                        <td>{{ $subscriber->email }}</td>
                                        <td>{{ $subscriber->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header bg-info text-white fw-bold">
                    <i class="fas fa-paper-plane me-2"></i>Envoyer un message à tous les abonnés
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.newsletter.send') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image (optionnelle)</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer à tous les abonnés</button>
                    </form>
                    @if(session('newsletter_sent'))
                        <div class="alert alert-success mt-3">{{ session('newsletter_sent') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger mt-3">{{ $errors->first() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 

