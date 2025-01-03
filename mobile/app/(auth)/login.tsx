import { sizes } from "@/config/designTokens";
import LoginScreen from "@/features/authentication/screens/LoginScreen";
import { SafeAreaView, StyleSheet, View } from "react-native";

export default function Login() {
  return (
    <View style={styles.container}>
      <LoginScreen />
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
