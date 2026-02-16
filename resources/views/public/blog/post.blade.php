@extends('_layouts.public')

@section('content')
    <header class="header">
        <h1 class="header__title">
            {{ $post->title }}
        </h1>
    </header>

    <section class="blog-detail card">
        @if($post->image_url)
            <div class="blog-card-image">
                <img
                    src="{{  $post->image_url }}"
                    alt="Post image" 
                    loading="lazy"
                />
            </div>
        @endif        
        <p>
            {{ $post->published_at?->format('d,m,Y') }}
        </p>   
        <div>{!! $post->text !!}</div>
    </section> 
    


    <section class="comment-form-section">
        {{-- форма нового комментария --}}
        @auth
            <form method="POST" action="{{route('blog.comments.store', ['post' => $post->slug])}}">
                @csrf
                <div class="mb-3">
                    <label for="body" class="form-label">Ваш комментарий</label>
                    <textarea class="form-control" name="body" rows="4" required>{{old('body')}}</textarea>
                    @error('body') <div class="text-danger">{{$message}}</div> @enderror
                </div>
                <button class="btn btn-primary">Отправить</button>
            </form>
        @else
            <form method="POST" action="{{route('comments.store', $post)}}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Имя</label>
                        <input type="text" class="form-control" name="guest_name" value="{{old('guest_name')}}" required>
                        @error('guest_name') <div class="text-danger">{{$message}}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="guest_email" value="{{old('guest_email')}}" required>
                        @error('guest_email') <div class="text-danger">{{$message}}</div> @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Комментарий</label>
                    <textarea class="form-control" name="body" rows="4" required>{{old('body')}}</textarea>
                    @error('body') <div class="text-danger">{{$message}}</div> @enderror
                </div>
                <button class="btn btn-primary">Отправить</button>
            </form>
        @endauth        
    </section>


    <section class="comment-list-section">
        <h3>Комментарии ({{$post->comments->count()}})</h3>
        @forelse($post->comments as $comment)
            <div class="border rounded p-3 mb-2">
                <strong>{{$comment->authorName()}}</strong>
                <small class="text-muted">{{$comment->created_at->diffForHumans()}}</small>
                <p class="mb-0">{{$comment->body}}</p>
            </div>
        @empty
            <p>Пока нет комментариев. Будьте первым!</p>
        @endforelse        
    </section>    

@endsection

