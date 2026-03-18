@extends('_layouts.admin')

@section('content')
    <div class="form-container">
        <header class="header">
            <h1 class="header__title">New Post</h1>
            <div class="header__actions">
                @include('admin._components.back-btn')
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
                    @include('admin._components.form.select-element', [
                        'name' => 'category_id',
                        'array' => $categories,
                        'item_id' => $category_id ?? null,
                        'placeholder' => '— Select category —'
                    ])     

                    @include('admin._components.form.input-element', ['name' => 'title'])

                    @include('admin._components.form.textarea-element', [
                        'name' => 'text',
                        'templates' => $templates
                    ])   

                    @include('admin._components.form.input-image-element')                                          
                      
                    @if(auth()->user()->is_admin)
                        @include('admin._components.form.select-boolean-element', [
                            'name' => 'is_published',
                            'value' => true,
                            'true_title' => 'Published',
                            'false_title' => 'Not published',
                        ])     
                    @endif                
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