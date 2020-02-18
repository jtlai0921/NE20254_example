public class Calc {
    float xi, yi;
    
    public Calc(){
        xi = 1.0f;
        yi = 1.0f;
    }
    public Calc(float x, float y){
	xi = x;
	yi = y;
    }
    public void set(float x, float y){
	xi = x;
	yi = y;
    }
    public float add(){
	return xi+yi;
    }
    public float sub(){
	return xi-yi;
    }
}
