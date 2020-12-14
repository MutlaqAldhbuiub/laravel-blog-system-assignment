@extends('layouts.master')


@section('article')
    <section class="blog__section">
        <div class="container primary">
            <div class="titleholder">
                <h1 class="single-title" id="title">
                    {{$post->title}}
                </h1>
                <input type="hidden" class="form-control" id="titleInput" name="title" value="{{$post->title}}">
            </div>

            @if($post->user_id == auth()->user()->id)
                <div class="buttons" style="text-align: center">
                    <button class="site-btn-warning" onclick="edit()" id="editButton">
                        تعديل
                    </button>

                    <button class="site-btn-success" style="display:none" onclick="update()" id="updateButton">
                        نشر التعديل 🚀
                    </button>


                    <button class="site-btn-danger" onclick="deletePost()">
                        حذف
                    </button>
                </div>
                <br>
            @endif


            @if($GenderPrefer)
                <p class="tracking-mode">
                    هذا المنشور غير مفضل للاطلاع عليه حسب تفضيلاتك.
                    <i class="fa fa-exclamation-circle"></i>
                </p>
            @endif
            <input type="hidden" name="user_id" value="{{$post->user_id}}">
            <div class="author">
                <a href="#">
                </a>
                <div class="twitterx">
                    <a target="_blank" href="#">
                        <i class="fa fa-twitter"></i>
                        {{ $post->user->name }}
                    </a>
                </div>
                <span class="date">
                    {{ $post->created_at->translatedFormat('d Y ,F ') }}
                </span>
                @if($post->updated)
                    <span class="date">
                        <br>
                        آخر تحديث في :
                        <span class="text-muted">
                        {{ $post->updated_at->translatedFormat('d Y ,F ') }}
                        </span>
                    </span>
                @endif
            </div>
            <div class="row blog_row pt-5">
                <div class="entry-content entry-content singlepostcontentarea">
                    <div id="body">
                        {!! $post->body !!}
                    </div>
                    <textarea name="body" class="form-control" rows="3" style="display:none" id="bodyInput">
                                {!! $post->body !!}
                    </textarea>
                    <div id="radioButtons" style="display: none;font-family:zarid-bold,serif">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="published" id="published1" value="1" {{$post->published ? 'checked': ''}}>
                            <label class="form-check-label" for="published1" style="margin-right: 21px;">
                                نشر
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="published" id="published2" value="0" {{$post->published ? '': 'checked'}}>
                            <label class="form-check-label" for="published2" style="margin-right: 21px;">
                                تعطيل النشر
                            </label>
                        </div>
                    </div>
                    <div class="commentsDIV">
                        <h2 class="footerBackground">التعليقات</h2>
                        <div class="pclist">
                            <div class="comments" id="comments">
                                @foreach($comments as $comment)
                                    <div class="pcbox relatedbox">
                                        <div class="pcinfo">
                                            <p>
                                                {{$comment->comment}}
                                            </p>
                                        </div>
                                        <div class="pcmoreinfo">
                                            <div class="pcdate">
                                                {{ $comment->created_at->diffForHumans() }}
                                            </div>
                                            <div class="pclefter">
                                                {{$comment->user->name}}
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @if (auth()->check())
                        <h2>انشر تعليقك!</h2>
                            <div class="addComment">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">محتوى التعليق</label>
                                    <input type="text" class="form-control" id="comment" aria-describedby="comment">
                                    <small id="comment" class="form-text text-muted">ثق تماماً ان لن ولم يتم نشر اي معلومات خاصة بك.</small>
                                </div>
                                <button type="submit" class="site-btn-success" onclick="comment()">انشر التعليق 🚀</button>
                            </div>
                        @endif
                    </div>
                    <h2 class="footerBackground">مقالات تستحق القراءة</h2>
                    <div id="pclist" class="relatedposts row">
                        @foreach($randomPosts as $random)
                            <div class="pcbox relatedbox">
                                <a href="{{$random->slug}}" alt="{{$random->title}}" title="{{$random->title}}">
                                    <figure>
                                        <img class="pcposter"
                                             src="{{$random->image_url}}"
                                             alt="{{$random->title}}"
                                             title="{{$random->title}}">
                                    </figure>
                                    <div class="padding20">
                                        <div class="pctopbox">
                                            <div class="titleinfo"> تدوينة</div>
                                            <h3> {{$random->title}}</h3>
                                            <div class="clear"></div>
                                        </div>
                                        <div class="pcinfo">
                                            <p>{!! substr($random->body,0,150) !!}</p>
                                        </div>
                                        <div class="pcmoreinfo">
                                            <div class="pcdate">
                                                {{$random->created_at->translatedFormat('d Y ,F ')}}
                                            </div>
                                            <div class="pclefter">
                                                {{$random->user->name}}
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="https://momentjs.com/downloads/moment.js">
    </script>
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
            var published = document.querySelector('input[name="published"]:checked').value;
            let radioButtons = document.getElementById("radioButtons");

            var request = new XMLHttpRequest();
            let windowOBJECT = window.location;
            let apiUrl = windowOBJECT.protocol+"//"+windowOBJECT.host+"/api/posts/{{$post->slug}}";

            var params = {
                'title':titleInput.value,
                'body':encodeURIComponent(CKEDITOR.instances.bodyInput.getData()),
                'published': published,
            }

            var endpoint = apiUrl + formatParams(params)

            request.open('PUT', apiUrl, true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request.send(formatParamsPost(params));


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

                    comments.innerHTML = '';
                    var data = JSON.parse(this.response);

                    for (let i = 0; i< data.length;i++){
                        m = moment(data[i].created_at);
                        formattedComments.push("<div class='pcbox relatedbox'><div class='pcinfo'><p>"+data[i].comment+"</p></div><div class='pcmoreinfo'><div class='pcdate'>"+m.format('MMMM Do YYYY')+"</div><div class='pclefter'>"+data[i].user.name+"</div><div class='clear'></div>");
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
        function formatParamsPost( params ){
            return Object
                .keys(params)
                .map(function(key){
                    return key+"="+encodeURIComponent(params[key])
                })
                .join("&")
        }

    </script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

    @endsection
    </html>
