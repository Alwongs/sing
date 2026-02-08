@extends('_layouts.admin')

@section('content')
    <div class="form-container">
        <header class="header">
            <h1 class="header__title">New Post</h1>
            <div class="header__actions">
                @include('admin.components.back-btn')
            </div>
        </header>

        <main class="main">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li style="color:red">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                @isset($category_id)
                    <input type="hidden" name="redirect" value="categories.show" />
                @endisset

                <div class="input-section">
                    @include('admin.components.form.select-element', [
                        'name' => 'category_id',
                        'array' => $categories,
                        'item_id' => $category_id ?? null,
                        'placeholder' => '— Select category —'
                    ])     

                    @include('admin.components.form.input-element', ['name' => 'title'])

                    @include('admin.components.form.textarea-element', ['name' => 'text'])   

                    @include('admin.components.form.input-image-element')                                          
                      
                    @include('admin.components.form.select-boolean-element', [
                        'name' => 'is_published',
                        'value' => true,
                        'true_title' => 'Published',
                        'false_title' => 'Not published',
                    ])                     
                </div>              
                
                <div class="submit-section">
                    <button
                        class="btn btn-submit"
                        type="submit"
                    >
                        Create
                    </button>
                </div>            
            </form>             
        </main>
    </div>


    <footer class="footer">
        footer
    </footer>
@endsection