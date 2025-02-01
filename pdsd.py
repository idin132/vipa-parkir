# Import Library  
import os  
import zipfile  
import numpy as np  
import matplotlib.pyplot as plt  
from tensorflow.keras.preprocessing.image import ImageDataGenerator, load_img, img_to_array  
from tensorflow.keras.models import Sequential  
from tensorflow.keras.layers import Conv2D, MaxPooling2D, Flatten, Dense, Dropout  
from tensorflow.keras.callbacks import EarlyStopping, ModelCheckpoint  
from tensorflow.keras.optimizers import Adam
import tensorflow as tf  
from google.colab import files  
from focal_loss import SparseCategoricalFocalLoss  

# Atur seed untuk konsistensi  
np.random.seed(42)  
tf.random.set_seed(42)

# Download Dataset  
!wget -O rockpaperscissors.zip https://github.com/tkjfakhrian/ImageClassification/releases/download/RockPaperScissorsDataset/rockpaperscissors.zip  

# Ekstrak Dataset  
if not os.path.exists('rockpaperscissors'):  
    with zipfile.ZipFile('rockpaperscissors.zip', 'r') as zip_ref:  
        zip_ref.extractall()  
  
base_dir = 'rockpaperscissors/rps-cv-images'

# Data Preprocessing dengan augmentasi gambar yang lebih ringan  
train_datagen = ImageDataGenerator(  
    rescale=1.0/255,  
    rotation_range=20,  # Kurangi rotasi  
    width_shift_range=0.2,  # Kurangi pergeseran  
    height_shift_range=0.2,  # Kurangi pergeseran  
    shear_range=0.2,  # Kurangi pemotongan  
    zoom_range=0.2,  # Kurangi zoom  
    horizontal_flip=True,  
    fill_mode='nearest',  
    brightness_range=[0.8, 1.2],  # Kurangi rentang kecerahan  
    validation_split=0.4  # Split untuk validation  
)  

# Membuat dataset train dan validation dengan class_mode 'sparse'  
train_generator = train_datagen.flow_from_directory(  
    base_dir,  
    target_size=(150, 150),  
    batch_size=32,  
    class_mode='sparse',  # Use 'sparse' for integer labels  
    subset='training'  
)  
  
validation_generator = train_datagen.flow_from_directory(  
    base_dir,  
    target_size=(150, 150),  
    batch_size=32,  
    class_mode='sparse',  # Use 'sparse' for integer labels  
    subset='validation'  
) 

# Periksa jumlah kelas  
print(train_generator.class_indices)

# Membangun Model dengan lebih banyak hidden layers  
model = Sequential([  
    Conv2D(32, (3, 3), activation='relu', input_shape=(150, 150, 3)),  
    MaxPooling2D(2, 2),  
    Conv2D(64, (3, 3), activation='relu'),  
    MaxPooling2D(2, 2),  
    Conv2D(128, (3, 3), activation='relu'),  
    MaxPooling2D(2, 2),  
    Conv2D(256, (3, 3), activation='relu'),  # Layer tambahan  
    MaxPooling2D(2, 2),  
    Flatten(),  
    Dense(1024, activation='relu'),  # Layer tambahan  
    Dropout(0.5),  
    Dense(512, activation='relu'),  # Layer tambahan  
    Dropout(0.5),  
    Dense(3, activation='softmax')  # 3 kelas: rock, paper, scissors  
])  

# Compile Model dengan SparseCategoricalFocalLoss  
model.compile(  
    optimizer=Adam(learning_rate=0.0001),  
    loss=SparseCategoricalFocalLoss(gamma=2),  # Keep this if using 'sparse'  
    metrics=['accuracy']  
)

# Callback Early Stopping dan Model Checkpoint  
early_stopping = EarlyStopping(monitor='val_loss', patience=5, restore_best_weights=True)  
model_checkpoint = ModelCheckpoint('best_model.keras', save_best_only=True, monitor='val_loss')  

# Training Model  
history = model.fit(  
    train_generator,  
    steps_per_epoch=len(train_generator),  
    epochs=50,  
    validation_data=validation_generator,  
    validation_steps=len(validation_generator),  
    callbacks=[early_stopping, model_checkpoint],  
    verbose=1  
)

# Evaluasi Model  
val_loss, val_accuracy = model.evaluate(validation_generator)  
print(f"Validation Accuracy: {val_accuracy * 100:.2f}%")

# Fungsi Prediksi Gambar  
def predict_image():  
    uploaded = files.upload()  
  
    for filename in uploaded.keys():  
        # Load dan preprocess gambar  
        img_path = filename  
        img = load_img(img_path, target_size=(150, 150))  
        img_array = img_to_array(img)  
        img_array = np.expand_dims(img_array, axis=0) / 255.0  
  
        # Prediksi  
        prediction = model.predict(img_array)  
        class_indices = list(train_generator.class_indices.keys())  
        predicted_class = class_indices[np.argmax(prediction)]  
        confidence = np.max(prediction) * 100  
  
        # Tampilkan hasil  
        plt.imshow(img)  
        plt.axis('off')  
        plt.title(f"Predicted: {predicted_class} ({confidence:.2f}%)")  
        plt.show()  
  
# Menjalankan fungsi prediksi gambar  
predict_image() 