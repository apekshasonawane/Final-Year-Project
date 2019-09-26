package mypkg.nonstopbusticket;

import android.content.Intent;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.File;

/**
 * Created by santosh on 3/16/2019.
 */

public class PrintTicket extends AppCompatActivity {
    Bundle b;
    Intent i;
    String tid,bus_number,destination,ticket_date,ticket_time,total_elder,total_child,total_senior,total_fair,paypal;
    TextView editTexttid,editTextbus_number,editTextdestination,editTextticket_date,editTextticket_time,editTexttotal_elder,editTexttotal_child,editTexttotal_senior,editTexttotal_fair,editTextPaypal;
    Button buttonBusTicket;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_print);

        i=getIntent();
        b=i.getExtras();
        tid=b.getString("TID");
        bus_number=b.getString("bus_number");
        destination=b.getString("destination");
        ticket_date=b.getString("ticket_date");
        ticket_time=b.getString("ticket_time");
        total_elder=b.getString("total_elder");
        total_child=b.getString("total_child");
        total_senior=b.getString("total_senior");
        total_fair=b.getString("total_fair");
        try {
            JSONObject jsonDetails =new JSONObject(b.getString("PaymentDetails"));
        }catch (JSONException e) {
            Toast.makeText(this, e.getMessage(), Toast.LENGTH_SHORT).show();
        }


        editTexttid=(TextView)findViewById(R.id.editTexttid);
        editTextbus_number=(TextView)findViewById(R.id.editTextbus_number);
        editTextdestination=(TextView)findViewById(R.id.editTextdestination);
        editTextticket_date=(TextView)findViewById(R.id.editTextticket_date);
        editTextticket_time=(TextView)findViewById(R.id.editTextticket_time);
        editTexttotal_elder=(TextView)findViewById(R.id.editTexttotal_elder);
        editTexttotal_child=(TextView)findViewById(R.id.editTexttotal_child);
        editTexttotal_senior=(TextView)findViewById(R.id.editTexttotal_senior);
        editTexttotal_fair=(TextView)findViewById(R.id.editTexttotal_fair);
        editTextPaypal=(TextView)findViewById(R.id.editTextPaypal);

        editTexttid.setText("Ticket Id : " + tid);
        editTextbus_number.setText("Bus Number : " + bus_number);
        editTextdestination.setText("Destination : " + destination);
        editTextticket_date.setText("Ticket Date : " + ticket_date);
        editTextticket_time.setText("Ticket Time : " + ticket_time);
        editTexttotal_elder.setText("Total Elder : " + total_elder);
        editTexttotal_child.setText("Total Child : " + total_child);
        editTexttotal_senior.setText("Total Senior : " + total_senior);
        editTexttotal_fair.setText("Total Fair: " + total_fair);




        editTextPaypal.setText("Paypal Approved");

        buttonBusTicket=(Button)findViewById(R.id.buttonBusTicket);
        buttonBusTicket.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                try {
                    File cacheDir = new File(
                            android.os.Environment.getExternalStorageDirectory(),
                            "msrtc");

                    if (!cacheDir.exists()) {
                        cacheDir.mkdirs();
                    }

                    String path = new File(
                            android.os.Environment.getExternalStorageDirectory(),
                            "msrtc") + "/screenshot.jpg";

                    Utils.savePic(Utils.takeScreenShot(PrintTicket.this), path);

                    Toast.makeText(getApplicationContext(), "Ticket Saved", Toast.LENGTH_SHORT).show();
                    finish();
                    System.exit(0);

                } catch (NullPointerException ignored) {
                    ignored.printStackTrace();
                }
            }
        });
    }
}
