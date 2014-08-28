<div class="panel panel-default" id="prescription-panel">
    <table class="table table-condensed">
        <thead>
            <tr class="active">
                <th>
                </th>    
                <th>度数(SPH)</th>
                <th>散光(CYL)</th>
                <th>轴位(AXIS)</th>
                <th>加光(ADD)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th valign="middle">左眼</th>
                @foreach($O_S_LEFTNames as $O_S_LEFTName)
                <td valign="middle">{{ $prescriptoion->$O_S_LEFTName }}</td>
                @endforeach
            </tr>
            <tr>
                <th valign="middle">右眼</th>
                @foreach($O_D_RIGHTNames as $O_D_RIGHTName)
                <td valign="middle">{{ $prescriptoion->$O_D_RIGHTName }}</td>
                @endforeach
            </tr>
            <tr>                
                <th valign="middle">瞳距(cm)</th>
                @foreach($CommonNames as $CommonName)
                <td valign="middle">{{ $prescriptoion->$CommonName }}</td>
                @endforeach
                <td></td><td></td><td></td>
            </tr>            
        </tbody>
    </table>       
</div>
