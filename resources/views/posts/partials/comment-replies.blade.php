@if ($replies->count() > 0)
    <ul class="list-group list-group-flush mt-1">
        @foreach ($replies as $reply)
            <li class="list-group-item">
                <div class="d-flex">
                    <img src="{{ asset('https://www.gravatar.com/avatar/0?s=40&d=mm') }}" alt="Commenter Avatar" class="rounded-circle me-3" style="width: 40px; height: 40px;">
                    <div class="media-body flex-grow-1 bg-light rounded p-2">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <strong>{{ $reply->user->name }}</strong>
                            <span class="text-muted">{{ $reply->created_at->diffForHumans() }}</span>
                        </div>
                        <p>{{ $reply->content }}</p>
                        @auth
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="#" class="btn btn-sm btn-outline-primary reply-btn" onclick="toggleReplyForm({{ $reply->id }})">Reply</a>
                                @if (auth()->user()->id == $reply->user_id)
                                    <form action="{{ route('posts.comment.destroy', [$post, $reply]) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                @endif
                            </div>
                            <!-- Form Reply untuk Balasan -->
                            <div class="reply-form mt-2" id="reply-form-{{ $reply->id }}" style="display: none;">
                                <form action="{{ route('posts.comment', $post) }}" method="post" class="comment-form">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <textarea name="content" id="comment-{{ $reply->id }}" class="form-control" rows="3" placeholder="Reply to comment..."></textarea>
                                        <label for="comment-{{ $reply->id }}">Reply</label>
                                        <input type="hidden" name="parent_comment_id" value="{{ $reply->id }}">
                                    </div>
                                    <button type="submit" class="btn btn-primary px-4">Submit</button>
                                </form>
                            </div>
                        @endauth
                        {{-- Recursively include replies --}}
                        @include('posts.partials.comment-replies', ['replies' => $reply->replies])
                    </div>
                </div>
            </li>
        @endforeach
    </ul>
@endif
