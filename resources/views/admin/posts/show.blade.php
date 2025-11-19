@extends('components.layouts.admin')

@section('content')
<div class="container-fluid post-detail-page">
    <h1>Detail Post</h1>
    <div class="post-content">
        <!-- Konten post -->
        <button id="like-btn" data-post-id="{{ $post->id }}">Like</button>
        <button id="share-btn">Share</button>
        
        <form id="comment-form">
            <textarea placeholder="Tulis komentar..."></textarea>
            <button type="submit">Kirim</button>
        </form>
    </div>
</div>
@endsection