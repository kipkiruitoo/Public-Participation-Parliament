@extends('layouts.manage') @section('content')

<div class="flex-container">
    <div class="colums m-t-10">
        <div class="column">
            <h1 class="title">Edit Bill</h1>
            <hr />
            <h3>{{$bill->title}}</h3>
        </div>
    </div>
    <hr class="m-t-0" />
    <div class="columns">
        <div class="column is-two-third">
            <div class="card">
                <!-- start of card content -->

                <div class="card-content">
                    <form
                        action="{{route('bill.update', $bill->id)}}"
                        method="POST"
                        role="form"
                        enctype="multipart/form-data"
                    >
                        {{ method_field("PUT") }}
                        @csrf
                        <div class="field">
                            <label for="title">Title</label>
                            <p class="control">
                                <input
                                    type="text"
                                    name="title"
                                    class="input"
                                    id="title"
                                    value="{{$bill->name}}"
                                    required
                                />
                            </p>
                        </div>
                        <div class="field">
                            <label for="number">Bill number</label>
                            <p class="control">
                                <input
                                    class="input"
                                    value="{{$bill->number}}"
                                    type="number"
                                    required
                                    name="number"
                                    id="number"
                                />
                            </p>
                        </div>
                        <!-- <p class="control">
                            <slug-widget url="{{url('/')}}" :title="title" @slug-changed="updateSlug"
                                subdirectory="bill">
                            </slug-widget>
                        </p> -->
                        <div class="field">
                            <p class="control">
                                <textarea
                                    type="textarea"
                                    class="textarea"
                                    name="description"
                                    required
                                    placeholder="A brief description of the bill"
                                    rows="10"
                                    >{{$bill->description}}</textarea
                                >
                            </p>
                        </div>

                        <div class="file">
                            <label class=" file-label">
                                <input
                                    type="file"
                                    class="file-input"
                                    name="bill"
                                />
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
                        <button
                            type="submit"
                            class=" button is-success  is-fullwidth m-t-20 m-l-5 m-r-5 m-b-10"
                        >
                            Edit
                        </button>
                    </form>
                </div>
                <!-- end of card content -->
            </div>
        </div>
        <div class="column is-one-third m-l-10">
            <div class="card card-widget">
                <div class="card-content">
                    <div class="publish-buttons-widget widget-area">
                        <div class="secondary-action-button">
                            <button
                                id="sectionsmodal"
                                class="button is-info is-outlined is-fullwidth"
                            >
                                Add Sections
                            </button>
                        </div>
                    </div>
                    <h2>Sections of the Bill</h2>
                    <div class="list is-hoverable">
                        @foreach ($sections as $section)
                        <p class="list-item m-b-10 m-l-10 m-r-5 p-l-10">
                            <form action="{{ route('sections.destroy',$section->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            {{ $section->name }}
                            <button type="submit" class="is-small button is-pulled-right is-danger m-b-20  m-r-20"><i
                                    class="fa fa-trash "></i></button>
                            </form>
                        </p>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="new_discussion" class="modal bounceInUp "> 
        <div class="modal-background"></div>
        <div class="modal-card">
            <form action="{{ route('sections.store') }}" method="POST">
                @csrf
                <header class="modal-card-head">
                    <p class="modal-card-title">Add a section</p>
                    <button class="delete cancel" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <div class="field">
                        <label for="title">Name</label>
                        <p class="control">
                            <input
                                type="text"
                                name="name"
                                class="input"
                                id="title"
                                value=""
                                required
                            />
                        </p>
                    </div>
                    <div class="field">
                        <label for="title">description</label>
                        <p class="control">
                            <input
                                type="text"
                                name="description"
                                class="input"
                                id="title"
                                value=""
                                required
                            />
                        </p>
                    </div>
                    <input type="hidden" name="bill" value="{{ $bill-> id}}" />
                </section>
                <footer class="modal-card-foot">
                    <button
                        type="submit"
                        class="button is-primary is-fullwidth is-outlined"
                    >
                        Add Section
                    </button>
                </footer>
            </form>
        </div>
    </div>
</div>
<script>
    var modalactivator = document.getElementById("sectionsmodal");
    var modalcanceller = document.querySelector(".cancel");
    var modal = document.querySelector(".modal");
    modalactivator.addEventListener("click", function() {
        console.log("clicked");
        modal.classList.add("is-active");
         modal.classList.add("bounceInRight");
    });
    modalcanceller.addEventListener("click", function() {
        modal.classList.remove("is-active");
    });
</script>
@endsection
