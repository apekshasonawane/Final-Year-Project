package mypkg.nonstopbusticket;

/**
 * Created by santosh on 3/15/2019.
 */

import java.util.ArrayList;

public class DataAdapter {
    private String bus_number;
    private String date;
    private String total_seats;
    private String fare;


    public String getBus_number() {
        return bus_number;
    }

    public void setBus_number(String bus_number) {
        this.bus_number = bus_number;
    }

    public String getDate() {
        return date;
    }

    public void setDate(String date) {
        this.date = date;
    }

    public String getTotal_seats() {
        return total_seats;
    }

    public void setTotal_seats(String total_seats) {
        this.total_seats = total_seats;
    }

    public String getFare() {
        return fare;
    }

    public void setFare(String fare) {
        this.fare = fare;
    }
}