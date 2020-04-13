<div class="form-group">
    <label for="exampleFormControlSelect1">{{ $labelText ?? "Select Article" }}</label>
    <select class="form-control" id="exampleFormControlSelect1">
        @foreach($articles as $article)
            <option value="{{$article->id}}">{{ $article->title }}</option>
        @endforeach
    </select>
</div>
