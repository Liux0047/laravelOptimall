<div class="panel panel-default" id="prescription-panel">
    <table class="table table-condensed prescription-table">
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
                @foreach($prescriptionNames['O_S_LEFTNames'] as $O_S_LEFTName)
                <td valign="middle">{{ $prescription->$O_S_LEFTName }}</td>
                @endforeach
            </tr>
            <tr>
                <th valign="middle">右眼</th>
                @foreach($prescriptionNames['O_D_RIGHTNames'] as $O_D_RIGHTName)
                <td valign="middle">{{ $prescription->$O_D_RIGHTName }}</td>
                @endforeach
            </tr>
            <tr>                
                <th valign="middle">瞳距(cm)</th>
                @foreach($prescriptionNames['CommonNames'] as $CommonName)
                <td valign="middle">{{ $prescription->$CommonName }}</td>
                @endforeach
                <td colspan="3"></td>
            </tr>            
        </tbody>
    </table>       
</div>
