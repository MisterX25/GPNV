@extends('layouts.project')

@section('projectContent')

    <div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Tâches</h1>
        </div>

        <div class="row">
                    <div id="projectTasks" class="panel-body projectTasks" data-projectid="{{$project->id}}">
                        <div id="filters" class="col-md-12">
                            <div class="awesomeCheckbox awesomeCheckbox-primary filterCheckboxes">
                                <span class="instruction">Afficher les tâches</span>
                                <input data-status-id="1" type="checkbox" checked="checked" id="checkWip" class="styled checkboxFilter">
                                <label for="checkWip" class="checkboxFilterLabel">
                                    <span class="taskStatus glyphicon glyphicon-time"></span>
                                    En cours
                                </label>

                                <input data-status-id="2" type="checkbox" id="checkTodo" class="styled checkboxFilter">
                                <label for="checkTodo" class="checkboxFilterLabel">
                                    <span class="taskStatus glyphicon glyphicon-pushpin"></span>
                                    A faire
                                </label>

                                <input data-status-id="3" type="checkbox" id="checkDone" class="styled checkboxFilter">
                                <label for="checkDone" class="checkboxFilterLabel">
                                    <span class="taskStatus glyphicon glyphicon-ok"></span>
                                    Terminée
                                </label>
                            </div>

                            <div class="dropdown dropTaskFilter">
                                <span class="instruction">assignées à</span>
                                <button class="btn btn-default dropdown-toggle" type="button" id="peopleDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span id="dropdownTitleOwner">N'importe qui</span>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu owner" aria-labelledby="peopleDropdown" >
                                    <li><a data-taskOwner="all" class="activeOwner">N'importe qui</a></li>
                                    <li><a data-taskOwner="{{$currentUser->id}}">Moi</a></li>
                                    <li><a data-taskOwner="nobody">Personne</a></li>
                                    <li role="separator" class="divider"></li>
                                    {{-- Displaying project members --}}
                                    @foreach($members as $member)
                                        {{-- Making sure not to display the current user --}}
                                        @unless($member->id == $currentUser->id)
                                            <li><a data-taskOwner="{{$member->id}}">{{$member->firstname}} {{$member->lastname}}</a></li>
                                        @endunless
                                    @endforeach
                                </ul>
                            </div>

                            <div class="dropdown dropTaskFilter">
                                <span class="instruction">et liées à</span>
                                <button class="btn btn-default dropdown-toggle" type="button" id="objectivesDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span id="dropdownTitleObjective">Tous les objectifs</span>
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu objective" aria-labelledby="objectivesDropdown" >
                                    <li><a data-objective="all" class="activeObjective">Tous les objectifs</a></li>
                                    @if($objectifs->showToDo())
                                        @foreach($objectifs->showToDo() as $checkListItem)
                                            <li><a data-objective="{{$checkListItem->id}}">{{$checkListItem->title}}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                            <!-- <hr/> -->
                        </div>

                        <div id="taskList" class="col-md-12">
                            <div class="tree-menu" id="tree-menu">
                                <ul>
                                    <!-- project tasks are displayed from refreshDisplayedTasks() in scripts.js -->
                                </ul>
                            </div>
                            @if(Auth::user()->projects()->find($project->id))
                                <a href="{{route('project.tasks.create',['projectID' => $project->id] ) }}" class="btn btn-primary editDescription">Créer une tâche</a>
                            @endif
                        </div>
                    </div>
                </div>

    </div>
        </div>
    @push('scripts')
        <script src="{{ URL::asset('js/tasks.js') }}"></script>
        <script src="{{ URL::asset('js/app.js') }}"></script>
    @endpush
@endsection
