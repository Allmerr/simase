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
    <h1 class="text-center">Skema</h1>
    <div class="row">
        <div class="col-md-3 border p-2 rounded">
            <form action="/blog" method="GET">
                <select class="form-select mb-2" name="author">
                    <option value="">author</option>
                </select>
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search..." name="search" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-9">
            @if ($skemas->count())
                <div class="my-big-card">
                    <div class="left">
                        <h3>{{ $skemas[0]->nama }}</h3>
                        <h6 style="color: #acacac" class="mt-2 mb-3">Create by <a href="" style="color: #696969">{{ $skemas[0]->nama }}</a> in <a style="color: #696969" href="">{{ $skemas[0]->nama }}</a></h6>
                        <p>{{ $skemas[0]->nama }}</p>
                        <a class="border border-secondary p-1 rounded text-dark" href="/blog/{{ $skemas[0]->nama }}">See More</a>
                    </div>
                    <div class="right">
                        <img src="https://source.unsplash.com/500x500" alt="">
                    </div>
                </div>
                {{-- akhir header --}}
                {{-- body --}}
                {{-- <div class="my-card-container mt-5 pb-5">
                    @foreach ($posts->skip(1) as $post)
                        <div class="card" style="">
                            <img src="https://source.unsplash.com/600x600" alt="">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text" style="color:#acacac;">Create by <a href="/blog?author={{ $post->author->username }}" style="color: #696969">{{ $post->author->name }}</a> in <a href="/blog?category={{ $post->category->slug }}" style="color: #696969">{{ $post->category->name }}</a></p>
                                <p style="color:#acacac;">Created at<span style="color: #696969">  {{ $post->created_at }} </span></p>
                                <a class="border border-secondary p-1 rounded text-dark" href="/blog/{{ $post->slug }}">See More</a>
                            </div>
                        </div>
                    @endforeach
                </div> --}}
                {{-- akhir body --}}
            @else
                <div class="alert alert-secondary">Posts No Found</div>
            @endif
        </div>
    </div>
</div>
@endsection