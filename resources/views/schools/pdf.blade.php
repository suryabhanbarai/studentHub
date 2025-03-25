<h1>{{ $school->name }}</h1>
<p>Address: {{ $school->address }}</p>
<p>State: {{ $school->state->name }}</p>
<!-- Include all fields and loop through students -->
@foreach($school->students as $student)
    <p>{{ $student->name }} - {{ $student->standard->name }} - {{ $student->gender }}</p>
@endforeach