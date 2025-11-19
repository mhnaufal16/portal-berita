// JavaScript khusus untuk management posts
document.addEventListener('DOMContentLoaded', function() {
    // Deteksi halaman detail post
    if (document.querySelector('.post-detail-page')) {
        initPostDetail();
    }
    
    // Deteksi halaman index posts
    if (document.querySelector('.posts-index-page')) {
        initPostsIndex();
    }
});

// Fungsi untuk halaman detail post
function initPostDetail() {
    console.log('Initializing post detail page');
    
    // Contoh functionality untuk detail post
    const likeBtn = document.getElementById('like-btn');
    const shareBtn = document.getElementById('share-btn');
    const commentForm = document.getElementById('comment-form');
    
    if (likeBtn) {
        likeBtn.addEventListener('click', handleLike);
    }
    
    if (shareBtn) {
        shareBtn.addEventListener('click', handleShare);
    }
    
    if (commentForm) {
        commentForm.addEventListener('submit', handleComment);
    }
}

// Fungsi untuk halaman index posts
function initPostsIndex() {
    console.log('Initializing posts index page');
    
    // functionality untuk index (search, filter, dll)
    const searchInput = document.getElementById('search-posts');
    if (searchInput) {
        searchInput.addEventListener('input', handleSearch);
    }
}

// Event handlers
function handleLike(e) {
    e.preventDefault();
    const postId = this.dataset.postId;
    console.log('Liking post:', postId);
    // AJAX request untuk like
}

function handleShare(e) {
    e.preventDefault();
    console.log('Sharing post');
    // Logic untuk share
}

function handleComment(e) {
    e.preventDefault();
    console.log('Submitting comment');
    // AJAX untuk submit comment
}

function handleSearch(e) {
    console.log('Searching:', e.target.value);
    // Logic untuk live search
}

// Export functions jika diperlukan
export { initPostDetail, initPostsIndex };