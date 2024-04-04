import java.util.Random;
import java.util.*;

public class HillClimbingCourseScheduling {

    static final int NUM_COURSES = 10;
    static final int MINIMUM_SKS = 10;
    static final int MAX_ITERATIONS = 1000;

    static class Course {
        String name;
        int sks;
        int time;

        Course(String name, int sks, int time) {
            this.name = name;
            this.sks = sks;
            this.time = time;
        }
    }

    static Course[] courses = new Course[NUM_COURSES];
    static int[] bestOrder = new int[NUM_COURSES];
    static int bestCompletionTime;

    static void initializeCourses() {
        courses[0] = new Course("Algoritma dan Pemrograman", 2, 100);
        courses[1] = new Course("Struktur Data", 3, 150);
        courses[2] = new Course("Bahasa Indonesia", 2, 100);
        courses[3] = new Course("Agama", 1, 50);
        courses[4] = new Course("Basis Data", 2, 100);
        courses[5] = new Course("Rekayasa Perangkat Lunak", 3, 150);
        courses[6] = new Course("Manajemen Proyek", 2, 100);
        courses[7] = new Course("Logika Diskrit", 2, 100);
        courses[8] = new Course("Pemrograman Web", 3, 150);
        courses[9] = new Course("Kecerdasan Buatan", 2, 100);
    }

    static int calculateCompletionTime(int[] order) {
        int completionTime = 0;
        for (int i : order) {
            completionTime += courses[i].time;
        }
        return completionTime;
    }

    static int calculateTotalSKS(int[] order) {
        int totalSKS = 0;
        for (int i : order) {
            totalSKS += courses[i].sks;
        }
        return totalSKS;
    }

    static void hillClimbing() {
        int[] currentOrder = new int[NUM_COURSES];
        int currentCompletionTime;
        int currentTotalSKS;
        Random random = new Random();

        // Inisialisasi urutan awal
        for (int i = 0; i < NUM_COURSES; i++) {
            currentOrder[i] = i;
        }

        bestOrder = currentOrder;
        bestCompletionTime = calculateCompletionTime(bestOrder);

        // Iterasi hill-climbing
        for (int iteration = 0; iteration < MAX_ITERATIONS; iteration++) {
            // Acak pertukaran dua mata kuliah
            int j;
            do {
                j = random.nextInt(NUM_COURSES);
            } while (j == 0);

            // Tukar mata kuliah
            int temp = currentOrder[0];
            currentOrder[0] = currentOrder[j];
            currentOrder[j] = temp;

            // Hitung waktu penyelesaian dan total SKS baru
            currentCompletionTime = calculateCompletionTime(currentOrder);
            currentTotalSKS = calculateTotalSKS(currentOrder);

            // Perbarui solusi terbaik jika diperlukan
            if (currentCompletionTime < bestCompletionTime && currentTotalSKS >= MINIMUM_SKS) {
                bestOrder = currentOrder.clone();
                bestCompletionTime = currentCompletionTime;
            }
        }
    }

    static void displayResult() {
        System.out.println("Urutan penyelesaian mata kuliah optimal:");
        for (int i = 0; i < NUM_COURSES; i++) {
            System.out.println((i + 1) + ". " + courses[bestOrder[i]].name);
        }
        System.out.println("Total waktu penyelesaian: " + bestCompletionTime + " menit");
        System.out.println("Total SKS: " + calculateTotalSKS(bestOrder));
    }

    public static void main(String[] args) {
        initializeCourses();
        hillClimbing();
        displayResult();
    }
}
