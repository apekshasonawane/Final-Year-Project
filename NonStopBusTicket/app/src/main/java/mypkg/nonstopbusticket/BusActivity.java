package mypkg.nonstopbusticket;

import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class BusActivity extends AppCompatActivity {
    Button btn1,btn2;
    EditText editTextDestination,editTextTID;
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_bus);

        editTextDestination=(EditText)findViewById(R.id.editTextDestination);
        btn1=(Button)findViewById(R.id.buttonSearchBus);
        btn1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
               /* Intent i=new Intent(BusActivity.this,BookActivity.class);
                startActivity(i);*/

                String dest=editTextDestination.getText().toString();
                Intent i=new Intent(BusActivity.this,SearchActivity.class);
                Bundle bundle=new Bundle();
                bundle.putString("dest2",editTextDestination.getText().toString());
                i.putExtras(bundle);
                startActivity(i);
            }
        });

        editTextTID=(EditText)findViewById(R.id.editTextTID);
        btn2=(Button)findViewById(R.id.buttonCancelTicket);
        btn2.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String tid=editTextTID.getText().toString();
                Intent i=new Intent(BusActivity.this,TicketCancelActivity.class);
                Bundle bundle=new Bundle();
                bundle.putString("tid",tid);
                i.putExtras(bundle);
                startActivity(i);
            }
        });
    }
}
