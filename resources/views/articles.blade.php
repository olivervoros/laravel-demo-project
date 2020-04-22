<h2>List of all articles</h2>
<h4>You should only be able to view your own article...</h4>
@foreach($articles as $article)
    <div>
        <p>ID: <b>{{ $article->id }}</b></p>
        <p>Title: {{ $article->title }}</p>
        <p>Author: {{ $article->user->name }}</p>
        <p><a href="{{ url('/articles/article')."/".$article->id }}">Click Here to view Article (GATE)</a></p>
        <p><a href="{{ url('/articles/anotherarticle')."/".$article->id }}">Click Here to view Article (POLICY)</a></p>
    </div>
    <br/><hr/>
@endforeach
