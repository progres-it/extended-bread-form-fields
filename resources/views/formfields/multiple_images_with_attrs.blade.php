<br>
@if(isset($dataTypeContent->{$row->field}))
    <?php $images = json_decode($dataTypeContent->{$row->field}); ?>
    @if($images != null)
        <div class="multiple-images">
            @foreach($images as $image)
                <div class="img_settings_container" data-field-name="{{ $row->field }}">
                    <img src="{{ Voyager::image( $image->name ) }}" data-image="{{ $image->name }}" data-id="{{ $dataTypeContent->getKey() }}">
                    <div class="links">
                        <a href="#" class="voyager-params show-inputs"></a>
                        <a href="#" class="voyager-x remove-multi-image-ext"></a>
                    </div>

                    <div class="form-group">
                        <label><b>Порядок:</b><input class="form-control" type="text" name="{{ $row->field }}_ext[{{ $loop->index }}][order]" value="{{ $image->order ?? '' }}"></label>
                        <label><b>Alt:</b><input class="form-control" type="text" name="{{ $row->field }}_ext[{{ $loop->index }}][alt]" value="{{ $image->alt }}"></label>
                        <label><b>Title:</b><input class="form-control" type="text" name="{{ $row->field }}_ext[{{ $loop->index }}][title]" value="{{ $image->title }}"></label>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

@endif
<div class="clearfix"></div>
<input @if($row->required == 1) required @endif type="file" name="{{ $row->field }}[]" multiple="multiple" accept="image/*">

<script>
document.addEventListener('DOMContentLoaded', function(){
    $('.remove-multi-image-ext').on('click', function (e) {
        e.preventDefault();
        $image = $(this).parent().siblings('img');

        params = {
            slug:         '{{ $dataType->slug }}',
            image:        $image.data('image'),
            id:           $image.data('id'),
            field:        $image.parent().data('field-name'),
            multiple_ext: true,
            _token:       '{{ csrf_token() }}'
        }

        $('.confirm_delete_name').text($image.data('image'));
        $('#confirm_delete_modal').modal('show');
    });

    $('.show-inputs').on('click', function (e) {
        e.preventDefault();
        $(this).parent().parent().children('.form-group').toggle();
    });
});
</script>

<style>
.multiple-images{
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 10px;
}
.multiple-images .links{
    justify-content: center;
    display: flex;
}
.multiple-images .links a{
    margin: 0 5px;
}
.multiple-images>div{
    display: flex;
    flex-direction: column;
    margin-right: 10px;
}
.multiple-images img{
    max-width:200px;
    height:auto;
    display:block;
    padding:2px;
    border:1px solid #ddd;
    margin-bottom:5px;
}
.multiple-images .form-group{
    display: none;
}
.multiple-images label{
    display: block;
}
.multiple-images label b{
    display: inline-block;
    font-weight: bold;
    font-size: 10px;
    width: 50px;
}
.multiple-images label input{
    width: 160px;
    display: inline-block;
}
</style>
