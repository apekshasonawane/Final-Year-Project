package mypkg.nonstopbusticket;

import android.app.Activity;
import android.app.DatePickerDialog;
import android.app.ProgressDialog;
import android.app.TimePickerDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.drawable.BitmapDrawable;
import android.graphics.drawable.Drawable;
import android.os.Bundle;
import android.os.Environment;
import android.support.annotation.Nullable;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.text.Editable;
import android.text.InputType;
import android.text.TextWatcher;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.TimePicker;
import android.widget.Toast;

import java.io.ByteArrayOutputStream;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.math.BigDecimal;
import java.text.SimpleDateFormat;
import java.util.Calendar;
import java.util.HashMap;
import java.util.Locale;
import java.util.Map;

import com.android.volley.DefaultRetryPolicy;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.itextpdf.text.BaseColor;
import com.itextpdf.text.Document;
import com.itextpdf.text.DocumentException;
import com.itextpdf.text.Image;
import com.itextpdf.text.Paragraph;
import com.itextpdf.text.Phrase;
import com.itextpdf.text.Rectangle;
import com.itextpdf.text.html.WebColors;
import com.itextpdf.text.pdf.PdfPCell;
import com.itextpdf.text.pdf.PdfPTable;
import com.itextpdf.text.pdf.PdfWriter;
import com.paypal.android.sdk.payments.PayPalConfiguration;
import com.paypal.android.sdk.payments.PayPalPayment;
import com.paypal.android.sdk.payments.PayPalService;
import com.paypal.android.sdk.payments.PaymentActivity;
import com.paypal.android.sdk.payments.PaymentConfirmation;

import org.json.JSONException;


/**
 * Created by santosh on 1/16/2019.
 */

public class BookActivity extends AppCompatActivity implements View.OnClickListener{
    private DatePickerDialog fromDatePickerDialog;
    TimePickerDialog timePickerDialog;
    private SimpleDateFormat dateFormatter;
    EditText editTextBusNumber,edDate,edTime,edElder,edChild,edSenior,edFair,editTextDest;

    int currentHour;
    int currentMinute;
    String amPm;
    Calendar calendar;
    Button buttonBusTicket;

    private static String S_URL =Config.TICKET_URL;
    private ProgressDialog pd;
    private Snackbar snackbar;
    Bundle b;
    Intent i;
    String busno,busdest,busdate,bustime,busfare;
    int fare,tot=0;

    //FOR PDF
    private PdfPCell cell;
    private Image bgImage;
    private String path;
    private File dir;
    private File file;
    String tid="";
    //use to set background color
    BaseColor myColor = WebColors.getRGBColor("#9E9E9E");
    BaseColor myColor1 = WebColors.getRGBColor("#757575");


    //Paypal intent request code to track onActivityResult method
    public static final int PAYPAL_REQUEST_CODE = 123;


    //Paypal Configuration Object
    private static PayPalConfiguration config = new PayPalConfiguration()
            // Start with mock environment.  When ready, switch to sandbox (ENVIRONMENT_SANDBOX)
            // or live (ENVIRONMENT_PRODUCTION)
            .environment(PayPalConfiguration.ENVIRONMENT_SANDBOX)
            .clientId(PayPalConfig.PAYPAL_CLIENT_ID);
    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_book);

        i=getIntent();
        b=i.getExtras();

        busno=b.getString("busno");
        busdest=b.getString("busdest");
        busdate=b.getString("busdate");
        bustime=b.getString("bustime");
        busfare=b.getString("busfare");

        fare=Integer.parseInt(busfare);

        pd = new ProgressDialog(BookActivity.this);
        dateFormatter = new SimpleDateFormat("dd-MM-yyyy", Locale.US);

        buttonBusTicket=(Button)findViewById(R.id.buttonBusTicket);

        editTextDest=(EditText)findViewById(R.id.editTextDest);
        editTextDest.setText(busdest.toString());

        editTextBusNumber=(EditText)findViewById(R.id.editTextBusNumber);
        editTextBusNumber.setText(busno.toString());

        edDate=(EditText)findViewById(R.id.editTextDate);
        edDate.setText(busdate.toString());

        edTime=(EditText)findViewById(R.id.editTextTime);
        edTime.setText(bustime.toString());

        edDate.setInputType(InputType.TYPE_NULL);
        edTime.setInputType(InputType.TYPE_NULL);
        edDate.requestFocus();
        edElder=(EditText)findViewById(R.id.editTextElder);
        edElder.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
            }

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
            }

            @Override
            public void afterTextChanged(Editable s) {
                int elder=Integer.parseInt(edElder.getText().toString());
                tot+=(elder*fare);

                edFair.setText(""+tot);
            }
        });

        edChild=(EditText)findViewById(R.id.editTextChild);
        edChild.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
            }

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
            }

            @Override
            public void afterTextChanged(Editable s) {
                int child=Integer.parseInt(edChild.getText().toString());
                tot+=(child*fare/2);

                edFair.setText(""+tot);
            }
        });

        edSenior=(EditText)findViewById(R.id.editTextSenior);
        edSenior.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
            }

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
            }

            @Override
            public void afterTextChanged(Editable s) {
                int senior=Integer.parseInt(edSenior.getText().toString());
                tot+=(senior*fare/2);

                edFair.setText(""+tot);
            }
        });

        edFair =(EditText)findViewById(R.id.editTextFair);
        edFair .setText(busfare.toString());

        setDateTimeField();

        edTime.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                calendar = Calendar.getInstance();
                currentHour = calendar.get(Calendar.HOUR_OF_DAY);
                currentMinute = calendar.get(Calendar.MINUTE);

                timePickerDialog = new TimePickerDialog(BookActivity.this, new TimePickerDialog.OnTimeSetListener() {
                    @Override
                    public void onTimeSet(TimePicker timePicker, int hourOfDay, int minutes) {
                        if (hourOfDay >= 12) {
                            amPm = "PM";
                        } else {
                            amPm = "AM";
                        }
                        edTime.setText(String.format("%02d:%02d", hourOfDay, minutes) + amPm);
                    }
                }, currentHour, currentMinute, false);

                timePickerDialog.show();
            }
        });

        buttonBusTicket.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                pd.setMessage("Ticket Booking . . .");
                pd.show();
                RequestQueue queue = Volley.newRequestQueue(BookActivity.this);
                String response = null;
                final String finalResponse = response;

                final  String bus_number,destination,ticket_date,ticket_time,total_elder,total_child,total_senior,total_fair;

                bus_number=editTextBusNumber.getText().toString();
                destination=editTextDest.getText().toString();
                ticket_date=edDate.getText().toString();
                ticket_time=edTime.getText().toString();
                total_elder=edElder.getText().toString();
                total_child=edChild.getText().toString();
                total_senior=edSenior.getText().toString();
                total_fair=edFair.getText().toString();

                StringRequest postRequest = new StringRequest(Request.Method.POST, S_URL,
                        new Response.Listener<String>()
                        {
                            @Override
                            public void onResponse(String response) {
                                pd.hide();
                                //Response
                                showSnackbar(response);


                               /* //Generate PDF FIle
                                //creating new file path
                                path = Environment.getExternalStorageDirectory().getAbsolutePath() + "/NonStopBusTicket/PDF Files";
                                dir = new File(path);
                                if (!dir.exists()) {
                                    dir.mkdirs();
                                }
                                try {
                                    createPDF();
                                } catch (FileNotFoundException e) {
                                    e.printStackTrace();
                                } catch (DocumentException e) {
                                    e.printStackTrace();
                                }*/
                            }
                        },
                        new Response.ErrorListener()
                        {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                // error
                                Log.d("ErrorResponse", finalResponse);
                            }
                        }
                ) {
                    @Override
                    protected Map<String, String> getParams()
                    {
                        Map<String, String> params = new HashMap<String, String>();
                        params.put("bus_number", bus_number);
                        params.put("destination", destination);
                        params.put("ticket_date", ticket_date);
                        params.put("ticket_time", ticket_time);
                        params.put("total_elder", total_elder);
                        params.put("total_child",total_child);
                        params.put("total_senior",total_senior);
                        params.put("total_fair",total_fair);

                        return params;
                    }
                };
                postRequest.setRetryPolicy(new DefaultRetryPolicy(0, DefaultRetryPolicy.DEFAULT_MAX_RETRIES, DefaultRetryPolicy.DEFAULT_BACKOFF_MULT));
                queue.add(postRequest);
            }

        });
    }

    public void showSnackbar(String stringSnackbar){

        /*snackbar.make(findViewById(android.R.id.content), stringSnackbar.toString(), Snackbar.LENGTH_SHORT)
                .setActionTextColor(getResources().getColor(R.color.colorPrimary))
                .show();*/

        tid=stringSnackbar;
        Toast.makeText(getApplicationContext(), "Ticket ID : " + stringSnackbar, Toast.LENGTH_LONG).show();
        //paypal integration

        Intent intent = new Intent(this, PayPalService.class);
        intent.putExtra(PayPalService.EXTRA_PAYPAL_CONFIGURATION, config);
        startService(intent);

        getPayment();

       /* Intent i=new Intent(BookActivity.this,PrintTicket.class);
        Bundle b=new Bundle();
        b.putString("TID",stringSnackbar);
        b.putString("bus_number",editTextBusNumber.getText().toString());
        b.putString("destination",editTextDest.getText().toString());
        b.putString("ticket_date",edDate.getText().toString());
        b.putString("ticket_time",edTime.getText().toString());
        b.putString("total_elder",edElder.getText().toString());
        b.putString("total_child",edChild.getText().toString());
        b.putString("total_senior",edSenior.getText().toString());
        b.putString("total_fair",edFair.getText().toString());
        i.putExtras(b);
        startActivity(i);*/

       /* if(stringSnackbar.equals("success")) {
            Toast.makeText(getApplicationContext(), "Ticket Generated.", Toast.LENGTH_LONG).show();
            Intent i=new Intent(BookActivity.this,TicketActivity.class);
            startActivity(i);
        }
        else if(stringSnackbar.equals("fail"))
            Toast.makeText(getApplicationContext(), "Ticket Fail.", Toast.LENGTH_LONG).show();*/
    }


    private void getPayment() {
        //Getting the amount from editText
        String paymentAmount = edFair.getText().toString();

        //Creating a paypalpayment
        PayPalPayment payment = new PayPalPayment(new BigDecimal(String.valueOf(paymentAmount)), "USD", "Bus Ticket",
                PayPalPayment.PAYMENT_INTENT_SALE);

        //Creating Paypal Payment activity intent
        Intent intent = new Intent(this, PaymentActivity.class);

        //putting the paypal configuration to the intent
        intent.putExtra(PayPalService.EXTRA_PAYPAL_CONFIGURATION, config);

        //Puting paypal payment to the intent
        intent.putExtra(PaymentActivity.EXTRA_PAYMENT, payment);

        //Starting the intent activity for result
        //the request code will be used on the method onActivityResult
        startActivityForResult(intent, PAYPAL_REQUEST_CODE);
    }
    private void setDateTimeField() {
        edDate.setOnClickListener(this);
        edTime.setOnClickListener(this);

        Calendar newCalendar = Calendar.getInstance();
        fromDatePickerDialog = new DatePickerDialog(this, new DatePickerDialog.OnDateSetListener() {
            public void onDateSet(DatePicker view, int year, int monthOfYear, int dayOfMonth) {
                Calendar newDate = Calendar.getInstance();
                newDate.set(year, monthOfYear, dayOfMonth);
                edDate.setText(dateFormatter.format(newDate.getTime()));
            }
        },newCalendar.get(Calendar.YEAR), newCalendar.get(Calendar.MONTH), newCalendar.get(Calendar.DAY_OF_MONTH));
        fromDatePickerDialog.getDatePicker().setMinDate(System.currentTimeMillis() - 1000);
    }

    public void onClick(View view) {
        if(view == edDate) {
            fromDatePickerDialog.show();
        }
    }

    public void createPDF() throws FileNotFoundException, DocumentException {
        //create document file
        Document doc = new Document();
        try {

            Log.e("PDFCreator", "PDF Path: " + path);
            SimpleDateFormat sdf = new SimpleDateFormat("ddMMyyyy");
            file = new File(dir, "Ticket PDF" + sdf.format(Calendar.getInstance().getTime()) + ".pdf");
            FileOutputStream fOut = new FileOutputStream(file);
            PdfWriter writer = PdfWriter.getInstance(doc, fOut);

            //open the document
            doc.open();
            //create table
            PdfPTable pt = new PdfPTable(3);
            pt.setWidthPercentage(100);
            float[] fl = new float[]{20, 45, 35};
            pt.setWidths(fl);
            cell = new PdfPCell();
            cell.setBorder(Rectangle.NO_BORDER);

            //set drawable in cell
            Drawable myImage = BookActivity.this.getResources().getDrawable(R.drawable.logo);
            Bitmap bitmap = ((BitmapDrawable) myImage).getBitmap();
            ByteArrayOutputStream stream = new ByteArrayOutputStream();
            bitmap.compress(Bitmap.CompressFormat.PNG, 100, stream);
            byte[] bitmapdata = stream.toByteArray();
            try {
                bgImage = Image.getInstance(bitmapdata);
                bgImage.setAbsolutePosition(330f, 642f);
                cell.addElement(bgImage);
                pt.addCell(cell);
                cell = new PdfPCell();
                cell.setBorder(Rectangle.NO_BORDER);
                cell.addElement(new Paragraph("NonStopBusTicket"));

                cell.addElement(new Paragraph(""));
                cell.addElement(new Paragraph(""));
                pt.addCell(cell);
                cell = new PdfPCell(new Paragraph(""));
                cell.setBorder(Rectangle.NO_BORDER);
                pt.addCell(cell);

                PdfPTable pTable = new PdfPTable(1);
                pTable.setWidthPercentage(100);
                cell = new PdfPCell();
                cell.setColspan(1);
                cell.addElement(pt);
                pTable.addCell(cell);
                PdfPTable table = new PdfPTable(6);

                float[] columnWidth = new float[]{6, 30, 30, 20, 20, 30};
                table.setWidths(columnWidth);


                cell = new PdfPCell();


                cell.setBackgroundColor(myColor);
                cell.setColspan(6);
                cell.addElement(pTable);
                table.addCell(cell);
                cell = new PdfPCell(new Phrase(" "));
                cell.setColspan(6);
                table.addCell(cell);
                cell = new PdfPCell();
                cell.setColspan(6);

                cell.setBackgroundColor(myColor1);

                cell = new PdfPCell(new Phrase("#"));
                cell.setBackgroundColor(myColor1);
                table.addCell(cell);
                cell = new PdfPCell(new Phrase("Bus Number"));
                cell.setBackgroundColor(myColor1);
                table.addCell(cell);
                cell = new PdfPCell(new Phrase("Date"));
                cell.setBackgroundColor(myColor1);
                table.addCell(cell);
                cell = new PdfPCell(new Phrase("Time"));
                cell.setBackgroundColor(myColor1);
                table.addCell(cell);
                cell = new PdfPCell(new Phrase("Total Elder"));
                cell.setBackgroundColor(myColor1);
                table.addCell(cell);
                cell = new PdfPCell(new Phrase("Total Child"));
                cell.setBackgroundColor(myColor1);
                table.addCell(cell);

                //table.setHeaderRows(3);
                cell = new PdfPCell();
                cell.setColspan(6);

                for (int i = 1; i <= 10; i++) {
                    table.addCell(String.valueOf(i));
                    table.addCell("Header 1 row " + i);
                    table.addCell("Header 2 row " + i);
                    table.addCell("Header 3 row " + i);
                    table.addCell("Header 4 row " + i);
                    table.addCell("Header 5 row " + i);

                }

                PdfPTable ftable = new PdfPTable(6);
                ftable.setWidthPercentage(100);
                float[] columnWidthaa = new float[]{30, 10, 30, 10, 30, 10};
                ftable.setWidths(columnWidthaa);
                cell = new PdfPCell();
                cell.setColspan(6);
                cell.setBackgroundColor(myColor1);
                cell = new PdfPCell(new Phrase("Total Nunber"));
                cell.setBorder(Rectangle.NO_BORDER);
                cell.setBackgroundColor(myColor1);
                ftable.addCell(cell);
                cell = new PdfPCell(new Phrase(""));
                cell.setBorder(Rectangle.NO_BORDER);
                cell.setBackgroundColor(myColor1);
                ftable.addCell(cell);
                cell = new PdfPCell(new Phrase(""));
                cell.setBorder(Rectangle.NO_BORDER);
                cell.setBackgroundColor(myColor1);
                ftable.addCell(cell);
                cell = new PdfPCell(new Phrase(""));
                cell.setBorder(Rectangle.NO_BORDER);
                cell.setBackgroundColor(myColor1);
                ftable.addCell(cell);
                cell = new PdfPCell(new Phrase(""));
                cell.setBorder(Rectangle.NO_BORDER);
                cell.setBackgroundColor(myColor1);
                ftable.addCell(cell);
                cell = new PdfPCell(new Phrase(""));
                cell.setBorder(Rectangle.NO_BORDER);
                cell.setBackgroundColor(myColor1);
                ftable.addCell(cell);
                cell = new PdfPCell(new Paragraph("Footer"));
                cell.setColspan(6);
                ftable.addCell(cell);
                cell = new PdfPCell();
                cell.setColspan(6);
                cell.addElement(ftable);
                table.addCell(cell);
                doc.add(table);
                Toast.makeText(getApplicationContext(), "created PDF", Toast.LENGTH_LONG).show();
            } catch (DocumentException de) {
                Log.e("PDFCreator", "DocumentException:" + de);
            } catch (IOException e) {
                Log.e("PDFCreator", "ioException:" + e);
            } finally {
                doc.close();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        //If the result is from paypal
        if (requestCode == PAYPAL_REQUEST_CODE) {

            //If the result is OK i.e. user has not canceled the payment
            if (resultCode == Activity.RESULT_OK) {
                //Getting the payment confirmation
                PaymentConfirmation confirm = data.getParcelableExtra(PaymentActivity.EXTRA_RESULT_CONFIRMATION);

                //if confirmation is not null
                if (confirm != null) {
                    try {
                        //Getting the payment details
                        String paymentDetails = confirm.toJSONObject().toString(4);
                        Log.i("paymentExample", paymentDetails);

                        //Starting a new activity for the payment details and also putting the payment details with intent
                        /*startActivity(new Intent(this, ConfirmationActivity.class)
                                .putExtra("PaymentDetails", paymentDetails)
                                .putExtra("PaymentAmount", paymentAmount));*/

                        Intent i=new Intent(BookActivity.this,PrintTicket.class);
                        Bundle b=new Bundle();
                        b.putString("TID",tid);
                        b.putString("bus_number",editTextBusNumber.getText().toString());
                        b.putString("destination",editTextDest.getText().toString());
                        b.putString("ticket_date",edDate.getText().toString());
                        b.putString("ticket_time",edTime.getText().toString());
                        b.putString("total_elder",edElder.getText().toString());
                        b.putString("total_child",edChild.getText().toString());
                        b.putString("total_senior",edSenior.getText().toString());
                        b.putString("total_fair",edFair.getText().toString());
                        b.putString("PaymentDetails",paymentDetails);
                        i.putExtras(b);
                        startActivity(i);
                    } catch (JSONException e) {
                        Log.e("paymentExample", "an extremely unlikely failure occurred: ", e);
                    }
                }
            } else if (resultCode == Activity.RESULT_CANCELED) {
                Log.i("paymentExample", "The user canceled.");
            } else if (resultCode == PaymentActivity.RESULT_EXTRAS_INVALID) {
                Log.i("paymentExample", "An invalid Payment or PayPalConfiguration was submitted. Please see the docs.");
            }
        }

    }

    @Override
    protected void onDestroy() {
        stopService(new Intent(this, PayPalService.class));
        super.onDestroy();
    }
}
