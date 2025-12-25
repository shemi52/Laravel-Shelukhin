@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Редактирование комментария</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('comment.update', $comment) }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label for="text">Комментарий</label>
                            <textarea class="form-control @error('text') is-invalid @enderror" 
                                      id="text" 
                                      name="text" 
                                      rows="4" 
                                      required>{{ old('text', $comment->text) }}</textarea>
                            
                            @error('text')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-primary">
                                Сохранить изменения
                            </button>
                            <a href="{{ route('article.show', $comment->article_id) }}" class="btn btn-secondary">
                                Отмена
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection