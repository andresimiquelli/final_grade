<style>
    body {
            font-family: 'Roboto', sans-serif;
            font-size: small;
        }

        .headerTable {
            margin-bottom: 20px;
        }

        .logoCell {
            width: 120px;
            text-align: center;
            font-weight: 700;
        }

        .logo {
            width: 58px;
        }

        .headerTable tr .label {
            font-weight: bold;
        }

        .headerTable tr .value {
            padding-right: 20px;
        }

        .headerTable tr .title {
            text-align: center;
            font-weight: 700;
        }

</style>
<table class="headerTable">
    <tr>
        <td class="logoCell" rowspan="3">
            <img class="logo" src="{{URL::asset('/images/logo_moria.svg')}}" alt="Logo do Instituto Moriá: a silhueta de um livro azul aberto com um círculo azul sobre o livro e dois triângulos retângulos, um de cada lado do círculo.">
            <br> Insituto Moriá
        </td>
        <td class="title" colspan="4">{{ $title }}</td>
    </tr>
    <tr>
        <td class="label">Curso:</td>
        <td class="value courseName">{{ $header->courseName }}</td>
        <td class="label">Turma:</td>
        <td class="value className">{{ $header->className }}</td>
    </tr>
    <tr>
        <td class="label">Disciplina:</td>
        <td class="value subjectName">{{ $header->subjectName }}</td>
        @if(property_exists($header, 'period'))
            <td class="label">Período:</td>
            <td class="value period">{{ $header->period }}</td>
        @else
            <td></td>
            <td></td>
        @endif
    </tr>
</table>
<hr>
