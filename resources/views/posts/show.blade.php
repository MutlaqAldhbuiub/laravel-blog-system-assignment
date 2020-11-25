@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('SHOW') }}</div>

                    <div class="card-body form-group">

                        @isset($post)
                            @if($GenderPrefer)
                                <div class="alert alert-warning">
                                    <b>This article is not preferred to you, according to your settings.</b>
                                </div>
                            @endif

                            <img src="{{$post->image_url}}" class="card-img-top" id="card-image">


                            <input type="hidden" name="user_id" value="{{$post->user_id}}">

                            <h2 id="title">{{$post->title}}</h2>

                            <input type="hidden" class="form-control" id="titleInput" name="title" value="{{$post->title}}">
                            <div id="body">
                                {!! $post->body !!}
                            </div>

                            <textarea name="body" class="form-control" rows="3" style="display:none" id="bodyInput">
                                {{$post->body}}
                            </textarea>

                            <div id="radioButtons" style="display: none">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="published" id="published1" value="1" {{$post->published ? 'checked': ''}}>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Published
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="published" id="published2" value="0" {{$post->published ? '': 'checked'}}>
                                    <label class="form-check-label" for="exampleRadios2">
                                        Unpublished
                                    </label>
                                </div>
                            </div>

                            <p>
                                Author : {{ $post->user->name }}
                            </p>
                                @if($post->user_id == auth()->user()->id)
                                    <button class="btn btn-primary" onclick="edit()" id="editButton">
                                        EDIT
                                    </button>

                                    <button class="btn btn-primary" style="display:none" onclick="update()" id="updateButton">
                                        UPDATE 🚀
                                    </button>


                                    <button class="btn btn-danger" onclick="deletePost()">
                                        DELETE
                                    </button>
                                @endif
                        @endisset
                    </div>

                    <hr>
                    <h4>Comments</h4>
                        <div class="comments" id="comments">
                            @foreach($comments as $comment)
                                Comment : {{$comment->comment}}<br>
                                Auth : {{$comment->user->name}}
                                <br>
                            @endforeach
                        </div>

                    <hr>
                    <h3>Adding new comment</h3>

                    <div class="addComment">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Comment</label>
                            <input type="text" class="form-control" id="comment" aria-describedby="comment">
                            <small id="comment" class="form-text text-muted">We'll never share your information with anyone else.</small>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="comment()">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    <script>
        function edit() {
            let title = document.getElementById("title");
            let body = document.getElementById("body");
            let bodyInput = document.getElementById("bodyInput");
            let titleInput = document.getElementById("titleInput");
            let radioButtons = document.getElementById("radioButtons");


            title.style.display = "none";
            body.style.display = "none";

            titleInput.type = "text"
            CKEDITOR.replace('bodyInput');

            let editButton = document.getElementById('editButton');
            let updateButton = document.getElementById('updateButton');
            editButton.style.display = "none";
            updateButton.style.display = "inline-block";
            radioButtons.style.display = "block";



        }
        function comment() {
            let comment = document.getElementById("comment").value;
            var request = new XMLHttpRequest();
            let windowOBJECT = window.location;
            let apiUrl = windowOBJECT.protocol+"//"+windowOBJECT.host+"/api/posts/{{$post->slug}}/comments";
            var params = {
                'comment':comment,
                'user_id': {{auth()->user()->id}},
            }
            var endpoint = apiUrl + formatParams(params)

            request.open('POST', endpoint, true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request.send();
            reloadComments();
        }
        function update() {
            let title = document.getElementById("title");
            let body = document.getElementById("body");
            let bodyInput = document.getElementById("bodyInput");
            let titleInput = document.getElementById("titleInput");
            var card_image = document.getElementById("card-image").src;
            var published = document.querySelector('input[name="published"]:checked').value;
            let radioButtons = document.getElementById("radioButtons");

            var request = new XMLHttpRequest();
            let windowOBJECT = window.location;
            let apiUrl = windowOBJECT.protocol+"//"+windowOBJECT.host+"/api/posts/{{$post->slug}}";
            var params = {
                'title':titleInput.value,
                'body':CKEDITOR.instances.bodyInput.getData(),
                'published': published,
                'image_url':card_image
            }
            var endpoint = apiUrl + formatParams(params)

            request.open('PUT', endpoint, true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request.send();


            title.style.display = "block";
            body.style.display = "block";
            titleInput.type = "hidden";
            CKEDITOR.instances.bodyInput.destroy();
            radioButtons.style.display = "none";
            bodyInput.style.display =  "none";


            let editButton = document.getElementById('editButton');
            let updateButton = document.getElementById('updateButton');
            editButton.style.display = "inline-block";
            updateButton.style.display = "none";

            updatePage()
        }
        function updatePage(){
            let title = document.getElementById("title");
            let body = document.getElementById("body");
            var card_image = document.getElementById("card-image").src;
            let windowOBJECT = window.location;
            let apiUrl = windowOBJECT.protocol+"//"+windowOBJECT.host+"/api/posts/{{$post->slug}}";
            var request = new XMLHttpRequest();
            request.open('GET', apiUrl, true);

            request.onload = function() {
                if (this.status >= 200 && this.status < 400) {
                    // Success!
                    var data = JSON.parse(this.response);
                    title.innerText = data.title;
                    body.innerHTML = data.body
                    card_image = data.image_url

                } else {
                    // We reached our target server, but it returned an error

                }
            };

            request.onerror = function() {
                // There was a connection error of some sort
            };

            request.send();

        }
        function reloadComments(){
            let comments = document.getElementById("comments");
            let formattedComments = [];

            let windowOBJECT = window.location;
            let apiUrl = windowOBJECT.protocol+"//"+windowOBJECT.host+"/api/posts/{{$post->slug}}/comments";
            var request = new XMLHttpRequest();
            request.open('GET', apiUrl, true);

            request.onload = function() {
                if (this.status >= 200 && this.status < 400) {
                    // Success!
                    // var child = comments.lastElementChild;
                    // while (child) {
                    //     comments.removeChild(child);
                    //     child = comments.lastElementChild;
                    // }

                    comments.innerHTML = '';
                    var data = JSON.parse(this.response);

                    for (let i = 0; i< data.length;i++){
                        formattedComments.push("<p>"+"Comment: "+data[i].comment+"<br>"+"Author: "+data[i].user.name);
                    }

                    for (let i = 0; i< data.length;i++){
                        var tag = document.createElement("p");
                        var text = document.createElement("EMPTY");
                        text.innerHTML = formattedComments[i];
                        tag.appendChild(text);
                        comments.appendChild(tag);
                    }



                } else {
                    // We reached our target server, but it returned an error

                }
            };

            request.onerror = function() {
                // There was a connection error of some sort
            };

            request.send();

        }
        function deletePost(){
            var request = new XMLHttpRequest();
            let windowOBJECT = window.location;
            let apiUrl = windowOBJECT.protocol+"//"+windowOBJECT.host+"/api/posts/{{$post->slug}}";
            var params = {
                'comment':comment,
                'user_id': {{auth()->user()->id}},
            }
            var endpoint = apiUrl + formatParams(params)

            request.open('DELETE', endpoint, true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request.send()
            window.location.replace(windowOBJECT.protocol+"//"+windowOBJECT.host+"/home");
        }

        function formatParams( params ){
            return "?" + Object
                .keys(params)
                .map(function(key){
                    return key+"="+encodeURIComponent(params[key])
                })
                .join("&")
        }

    </script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@endsection
@endsection

