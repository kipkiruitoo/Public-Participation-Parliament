@extends('layouts.manage')

@section('content')

<div class="flex-container">
    <div class="colums m-t-10">
        <div class="column">
            <h1 class="title">Create new Bill</h1>
        </div>
    </div>
    <hr class="m-t-0">
    <div class="columns">
        <div class="column is-three-quarters">
            <div class="card">
                <!-- start of card content -->

                <div class="card-content">

                    <form action="{{route('bill.store')}}" method="post" role="form" enctype="multipart/form-data">
                        @csrf
                        <div class="field">
                            <label for="title">Title</label>
                            <p class="control">
                                <input type="text" name="title" class="input" id="title" required v-model="title">
                            </p>
                        </div>
                        <div class="field">
                            <label for="number">Bill number</label>
                            <p class="control">
                                <input class="input" type="number" required name="number" id="number">
                            </p>
                        </div>
                        <!-- <p class="control">
                            <slug-widget url="{{url('/')}}" :title="title" @slug-changed="updateSlug"
                                subdirectory="bill">
                            </slug-widget>
                        </p> -->
                        <div class="field">
                            <p class="control">
                                <textarea type="textarea" class="textarea" name="description" required
                                    placeholder="A brief description of the bill" rows="10"></textarea>
                            </p>
                        </div>

                        <div class="file">
                            <label class=" file-label">
                                <input type="file" required class="file-input" name="bill">
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fa fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        Choose a file
                                    </span>
                                </span>
                            </label>
                        </div>
                        <button type="submit"
                            class=" button is-success  is-fullwidth m-t-20 m-l-5 m-r-5 m-b-10">Create</button>

                    </form>


                </div><!-- end of card content -->

            </div>
        </div>
        <div class="column is-one-quarter is-narrow-tablet">
            <div class="card card-widget">
                <div class="card-content">
                    <div class="author-widget widget-area">
                        <div class="selected-author">
                            <img src="https://placehold.it/50x50" alt="author">
                            <div class="author">
                                <h4>By: </h4>
                            </div>

                        </div>

                    </div>
                    <div class="post-status-widget widget-area">
                        <div class="status">
                            <div class="status-icon">
                                <span class="icon">
                                    <i class="fa fa-clipboard"></i>
                                </span>
                            </div>
                        </div>
                        <div class="status-details">
                            <h4>Draft</h4>
                            <p>Saved a few minutes ago</p>
                        </div>

                    </div>
                    <div class="publish-buttons-widget widget-area">
                        <div class="secondary-action-button">
                            <button class="button is-info is-outlined is-fullwidth">Save Draft</button>
                        </div>
                        <div class="primary-action-button">
                            <button class="button is-primary is-fullwidth">Publish</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
</script>
@endpush
