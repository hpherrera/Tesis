@if(\Auth::user()->Estudiante())
	@extends('estudiante.index')
@endif
@if(\Auth::user()->Funcionario())
	@extends('funcionario.index')
@endif


