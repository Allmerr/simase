@extends('peserta.layouts.main')
@section('content')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Inspiration&family=Source+Sans+Pro:ital,wght@0,400;0,700;1,400&family=Viga&display=swap");

* {
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    font-family: "Viga";
}

body a {
    text-decoration: none;
}

body .base-parent {
    min-height: 100vh;
    background-color: #f5f5f7;
    margin-top: -16px;
    padding-top: 16px;
}

html body .base {
    display: flex;
    flex-direction: column;
    height: 85vh;
    justify-content: center;
    align-items: center;
}

.mylink {
    margin-top: -30px;
}

.my-big-card {
    cursor: pointer;
    background-color: #fff;
    overflow: hidden;
    border-radius: 20px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
}

.my-big-card .left {
    padding: 20px 60px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: justify;
}

.my-big-card .right img {
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
    width: 100%;
}

.my-card-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 25px;
}

.my-card-container .card {
    border: none;
    border-radius: 20px;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
}

.my-card-container .card img {
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
}

.blog-content {
    margin: 0 20%;
}

.blog-content img {
    width: 100%;
    margin: 50px 0;
}

.card-content {
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3);
}

.categories .card-category {
    border: none;
    box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;
}

@media (max-width: 912px) {
    .my-big-card {
        display: grid;
        grid-template-columns: 1fr;
    }

    .my-big-card .left {
        padding: 20px;
    }

    .my-big-card .right {
        grid-row: 1;
    }

    .my-big-card .right img {
        border-bottom-right-radius: 0px;
    }
}

@media (max-width: 768px) {
    .blog-content {
        margin: 0;
    }

    .blog-content img {
        margin: 10px 0;
    }
}
</style>
<div class="container">
    <h1>Skema</h1>
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <form action="/blog" method="GET">
                <select class="form-select mb-2" name="category">
                    <option value="">category</option>
                    {{-- @foreach ($categories as $category)
                        @if ($category->slug == request('category'))
                            <option value="{{ $category->slug }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->slug }}">{{ $category->name }}</option>
                        @endif
                    @endforeach --}}
                </select>
                <select class="form-select mb-2" name="author">
                    <option value="">author</option>
                    {{-- @foreach ($authors as $author)
                        @if ($author->username == request('author'))
                            <option value="{{ $author->username }}" selected>{{ $author->name }}</option>
                        @else
                            <option value="{{ $author->username }}">{{ $author->name }}</option>
                        @endif
                    @endforeach --}}
                </select>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>
        </div>
</div>
@endsection