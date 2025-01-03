import { SafeAreaView, StyleSheet, View } from "react-native";
import RegisterScreen from "@/features/authentication/screens/RegisterScreen";
import { sizes } from "@/config/designTokens";

export default function Register() {
  return (
    <View style={styles.container}>
      <RegisterScreen />
    </View>
  );
}

const styles = StyleSheet.create({
  container: {
    padding: sizes.base,
    flex: 1,
    flexDirection: "column",
    justifyContent: "center",
  },
});
