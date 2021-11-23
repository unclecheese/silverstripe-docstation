import Injector from 'lib/Injector';
import Docstation from '../components/Docstation'
export default () => {
  Injector.component.registerMany({
    Docstation,
  });
};

